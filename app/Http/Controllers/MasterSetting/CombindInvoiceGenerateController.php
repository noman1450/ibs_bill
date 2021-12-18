<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\Service;

class CombindInvoiceGenerateController extends Controller
{
    public function index()
    {
        $months = DB::table('month')->get();

        return view('MasterSetting.combind_invoice.index', compact('months'));
    }

    public function getData(Request $request)
    {
        $condition = '';

        if ($request->client_information_id) {
            $condition = " and c.client_information_id = $request->client_information_id";
        }

        $month_id = implode(',', $request->month_id ?? [0]);

        $data = DB::select("
            select
                b.id,
                a.id as maintenace_bill_ledger_id,
                e.client_name as customer,

                c.to_information,
                c.from_information,
                a.software_name,
                c.send_to,

                a.payableamount as amount,
                b.bill_no,
                date_format(b.created_at, '%d %b, %Y') as created_at,
                concat_ws(' | ', d.name, b.year_id) as month_year
            from
            maintenace_bill_ledger as a
                join
            maintenace_bill as b on a.maintenace_bill_id = b.id
                join
            service_confiq as c on a.service_confiq_id = c.id and c.valid = 1
                join
            month as d on b.month_id = d.id
                join
            client_information as e on c.client_information_id = e.id
                where
                    b.year_id = $request->year_id
                and
                    b.month_id in ($month_id)
                $condition
        ");

        return datatables()->of($data)
            ->make(true);
    }

    public function generate(Request $request)
    {
        $data['info'] = DB::table('maintenace_bill as a')
            ->selectRaw("
                a.id,
                c.client_name,
                c.address as client_address,
                a.send_to
            ")
            ->join('client_information as c', 'a.client_information_id', '=', 'c.id')
            ->where('c.id', $request->client_id)
            ->first();

        $data['details'] = DB::table('maintenace_bill as a')
            ->selectRaw("
                a.id,
                b.software_name,
                b.payableamount as amount,
                concat_ws(' - ', d.name, a.year_id) as month_year
            ")
            ->join('maintenace_bill_ledger as b', 'b.maintenace_bill_id', '=', 'a.id')
            ->join('client_information as c', 'a.client_information_id', '=', 'c.id')
            ->join('month as d', 'a.month_id', '=', 'd.id')
            ->whereIn('b.id', $request->ids)
            ->get();

        $data['bill_no'] = Service::generate_tr_number("maintenace_bill", "bill_no");

        $pdf = PDF::loadView('mails.multiple', $data);

        return $pdf->stream('invoice.pdf');
    }
}
