<?php

namespace App\Http\Controllers\MasterSetting;

use PDF;
use Terbilang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\MaintenaceBillLedger;
use App\Models\MasterSetting\Service;
use App\Models\TempMaintenaceBill;
use App\Models\TempMaintenaceBillLedger;
use Carbon\Carbon;

class DueCollectionController extends Controller
{
    public function cllientdueinfo()
    {
        return view('MasterSetting.duecollection.duecollection');
    }

    public function customer_name_list(Request $request)
    {
        $data = DB::SELECT("SELECT id, CONCAT(ifnull(client_code,''),' | ', client_name) as text, from_email, email, cc_email  FROM client_information
             WHERE client_name LIKE '%$request->term%' OR client_code LIKE '%$request->term%'");

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
            ->selectRaw('c.id,a.id as service_confiq_id, b.client_name as customer, a.software_name, a.valid, sum(e.payableamount - e.receiving_amount) as collect_amount, d.name as month_name')
            ->groupBy('c.id')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function collectduesubmit(Request $request)
    {
        if ($request->submit === 'collect') {
            if (empty($request->service_conf_ids)) {
                return back()->with('alert-danger', 'Please Check This List,Some Employees has no finger code!');
            }

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

            foreach ($collection as $collect) {
                $billLedger = new MaintenaceBillLedger;
                $billLedger->maintenace_bill_id = $collect->maintenace_bill_id;
                $billLedger->payableamount = 0;
                $billLedger->receiving_amount = $collect->collect_amount;
                $billLedger->save();
            }

            return redirect('dueCollection')->with('success', 'Due collection save successfully.!');
        }

        if ($request->submit === 'print') {
            ini_set('max_execution_time', 300);

            DB::beginTransaction();
            try {
                $tempMaintenaceBillId = TempMaintenaceBill::create([
                    'bill_no' => 'IBS-'.Service::generate_tr_number('temp_maintenace_bill', 'bill_no'),
                    'bill_date' => Carbon::now()->toDateTimeString()
                ])->id;

                foreach ($request->maintenace_bill_id as $collect) {
                    TempMaintenaceBillLedger::create([
                        'temp_maintenace_bill_id' => $tempMaintenaceBillId,
                        'maintenace_bill_id' => $collect
                    ]);
                }

                $collection = DB::SELECT("SELECT
                            a.bill_no,
                            a.bill_date,
                            c.year_id,
                            f.name AS month_name,
                            g.client_name,
                            g.address,
                            g.email AS client_email,
                            d.send_to,
                            d.software_name,
                            d.to_information,
                            e.payableamount
                        FROM
                            temp_maintenace_bill a
                                JOIN
                            temp_maintenace_bill_ledger b ON a.id = b.temp_maintenace_bill_id
                                AND a.id= $tempMaintenaceBillId
                                JOIN
                            maintenace_bill c ON b.maintenace_bill_id = c.id
                                JOIN
                            service_confiq d ON c.service_confiq_id = d.id
                                JOIN
                            maintenace_bill_ledger e ON c.id = e.maintenace_bill_id
                                JOIN
                            month f ON c.month_id = f.id
                                JOIN
                            client_information g ON d.client_information_id = g.id");

                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
            }

            $data['collection'] = collect($collection);

            $data['reserve'] = 'dsfdsfds';

             $pdf = PDF::loadView('MasterSetting.duecollection.pdf', $data);

             return $pdf->stream();

            return view('MasterSetting.duecollection.pdf', $data);
        }
    }
}
