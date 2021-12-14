<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\Service;

class ProcessServiceController extends Controller
{
    public function index()
    {
        $months = DB::table('month')->get();

        return view('MasterSetting.process_view.index', compact('months'));
    }

    public function getData(Request $request)
    {
        $condition = '';

        if ($request->client_information_id) {
            $condition = " and s.client_information_id = $request->client_information_id";
        }

        $month_id = implode(',', $request->month_id);

        $data = DB::select("
            select m.id, c.client_name as customer, s.to_information, s.from_information,
                s.software_name, s.valid, s.send_to, s.amount,
                m.bill_no,
                date_format(m.created_at, '%d %b, %Y') as created_at,
                concat_ws(' | ', mm.name, m.year_id) as month_year
            from
            maintenace_bill as m
                join
            service_confiq as s on m.service_confiq_id = s.id and s.valid = 1
                join
            month as mm on m.month_id = mm.id
                join
            client_information as c on s.client_information_id = c.id
                where
                    m.year_id = $request->year_id
                and
                    m.month_id in ($month_id)
                $condition
        ");

        return datatables()->of($data)
            ->make(true);
    }

    public function generate(Request $request)
    {
        // dd($request->ids);
        $data['info'] = DB::table('maintenace_bill as m')
            ->selectRaw("
                m.id,
                c.client_name,
                c.address as client_address,
                s.send_to
            ")
            ->join('service_confiq as s', function($join) {
                $join->on('m.service_confiq_id', '=', 's.id')
                    ->where('s.valid', 1);
            })
            ->join('month as mm', 'm.month_id', '=', 'mm.id')
            ->join('client_information as c', 's.client_information_id', '=', 'c.id')
            ->whereIn('m.id', $request->ids)
            ->first();


        $data['details'] = DB::table('maintenace_bill as m')
            ->selectRaw("
                m.id,
                s.software_name,
                s.amount,
                concat_ws(' - ', mm.name, m.year_id) as month_year
            ")
            ->join('service_confiq as s', function($join) {
                $join->on('m.service_confiq_id', '=', 's.id')
                    ->where('s.valid', 1);
            })
            ->join('month as mm', 'm.month_id', '=', 'mm.id')
            ->join('client_information as c', 's.client_information_id', '=', 'c.id')
            ->whereIn('m.id', $request->ids)
            ->get();

        // dd($data);

        $data['bill_no'] = Service::generate_tr_number("maintenace_bill", "bill_no");

        $pdf = PDF::loadView('mails.multiple', $data);

        return $pdf->stream('invoice.pdf');
    }
}
