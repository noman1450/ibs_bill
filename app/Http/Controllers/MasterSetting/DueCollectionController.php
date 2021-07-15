<?php

namespace App\Http\Controllers\MasterSetting;

use PDF;
use Terbilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\MaintenaceBillLedger;

class DueCollectionController extends Controller
{
    public function cllientdueinfo()
    {
        return view('MasterSetting.duecollection.duecollection');
    }

    public function customer_name_list(Request $request)
    {
        $data = DB::table('client_information')
            ->select('id', 'client_name as text')
            ->where('client_name', 'like', "%$request->term%")
            ->get();

        return response()->json($data);
    }

    public function client_information_data_list(Request $request)
    {
        $data = DB::table('service_confiq as a')
            ->where('a.valid', 1)
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->join('maintenace_bill as c', 'c.service_confiq_id', '=', 'a.id')
            ->join('month as d', 'c.month_id', '=', 'd.id')
            ->join('maintenace_bill_ledger as e', 'e.maintenace_bill_id', '=', 'c.id')
            ->where('b.id', $request->customer)
            ->selectRaw('a.id, b.client_name as customer, a.software_name, a.valid, sum(e.payableamount - e.receiving_amount) as collect_amount, d.name as month_name')
            ->groupBy('c.id')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function collectduesubmit(Request $request)
    {
        $collection = DB::table('service_confiq as a')
            ->join('maintenace_bill as c', 'c.service_confiq_id', '=', 'a.id')
            ->join('maintenace_bill_ledger as e', 'e.maintenace_bill_id', '=', 'c.id')
            ->selectRaw('a.id, a.software_name, a.send_to, a.amount,
                sum(e.payableamount - e.receiving_amount) as collect_amount,
                c.id as maintenace_bill_id'
            )
            ->groupBy('c.id')
            ->whereIn('a.id', $request->service_conf_ids)
            ->get();

        if ($request->submit_btn === 'collect') {
            if (empty($request->service_conf_ids)) {
                return back()->with('alert-danger', 'Please Check This List,Some Employees has no finger code!');
            }

            foreach ($collection as $collect) {
                $billLedger = new MaintenaceBillLedger;
                $billLedger->maintenace_bill_id = $collect->maintenace_bill_id;
                $billLedger->payableamount = 0;
                $billLedger->receiving_amount = $collect->collect_amount;
                $billLedger->save();
            }
        }

        if ($request->submit_btn === 'print') {
            return view('MasterSetting.duecollection.print-preview', compact('collection'));
        }

        // return response()->json([
        //    'success' => true,
        //    'messages' => 'Successfully updated!'
        // ]);
    }

    public function gotoprint(Request $request)
    {
        dd($request->all());
    }
}
