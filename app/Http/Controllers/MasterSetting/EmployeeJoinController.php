<?php

namespace App\Http\Controllers\MasterSetting;

use App\Jobs\SendMailToClientJob;
use App\Models\MasterSetting\Maintenace;
use App\Models\MasterSetting\MaintenaceBillLedger;
use App\Models\MasterSetting\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Riskihajar\Terbilang\Facades\Terbilang;

class EmployeeJoinController extends Controller
{
    public function index()
    {
        $months = DB::table('month')->get();

        return view('MasterSetting.join_employee.employeeidcard', compact('months'));
    }

    public function getData(Request $request)
    {
        $data = DB::select("
            select m.id, c.client_name as customer, s.to_information, s.from_information,
                    s.software_name, s.valid, s.send_to, s.amount,
                    m.bill_no,
                    m.service_confiq_id,
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
                    m.month_id = $request->month_id
        ");

        return datatables()->of($data)
            ->make(true);
    }

    public function view($id)
    {
        $data['data'] = DB::table('maintenace_bill as a')
            ->join('service_confiq as b', 'b.id', '=', 'a.service_confiq_id')
            ->join('client_information as c', 'c.id', '=', 'b.client_information_id')
            ->join('month as d', 'a.month_id', '=', 'd.id')
            ->selectRaw("
                a.id,
                a.send_to,
                a.amount,
                a.bill_no,
                a.created_at,
                c.client_name,
                b.software_name,
                c.address as client_address,
                concat_ws(' - ', d.name, a.year_id) as month_year
            ")
            ->where('a.id', $id)
            ->first();

        $data['word'] = Terbilang::make($data['data']->amount);

        return view('MasterSetting.join_employee.view', $data);
    }

    public function show($id, Request $request)
    {
        $data['data'] = DB::table('maintenace_bill as a')
            ->join('service_confiq as b', 'b.id', '=', 'a.service_confiq_id')
            ->join('client_information as c', 'c.id', '=', 'b.client_information_id')
            ->join('month as d', 'a.month_id', '=', 'd.id')
            ->selectRaw("
                a.id,
                a.send_to,
                a.amount,
                a.bill_no,
                a.created_at,
                c.client_name,
                b.software_name,
                c.address as client_address,
                concat_ws(' - ', d.name, a.year_id) as month_year
            ")
            ->where('a.id', $id)
            ->first();

        // dd($data);

        // SendMailToClientJob::dispatch($data);

        $data['word'] = Terbilang::make($data['data']->amount);

        $pdf = PDF::loadView('mails.pdf', $data);

        return $pdf->stream('invoice.pdf');
    }

    public function store(Request $request)
    {
        $services = DB::select("
            select
                a.id, a.from_information, c.client_name, c.address as client_address,
                c.email as client_email, a.software_name, a.send_to, a.amount
            from
                service_confiq as a
            join
                client_information as c on c.id = a.client_information_id
                where a.id not in (select service_confiq_id from maintenace_bill where year_id = $request->year and month_id = $request->month)
        ");

        if (empty($services)) {
            $success = false;
            $message = "Data already exists...!";
        } else {
            foreach ($services as $key => $service) {
                $this->fillOtherTable($request, $service);
            }

            $success = true;
            $message = "Data processed successfully..!";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function edit($id)
    {
        $maintenance = Maintenace::query()->findOrFail($id);

        return view('MasterSetting.join_employee.edit', compact('maintenance'));
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'bill_no' => 'required',
            'created_at' => 'required',
            'send_to' => 'required',
            'amount' => 'required',
        ]);

        $maintenance = Maintenace::query()->findOrFail($id);

        $maintenance->update($data);

        return redirect()->to('/process_service');
    }

    protected function fillOtherTable($request, $service)
    {
        $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");

        DB::transaction(function () use ($service, $request, $bill_no) {
            $maintenance = new Maintenace;
            $maintenance->service_confiq_id = $service->id;
            $maintenance->year_id = $request->year;
            $maintenance->month_id = $request->month;
            $maintenance->bill_no = 'IBS-'.$bill_no;
            $maintenance->amount = $service->amount;
            $maintenance->send_to = $service->send_to;
            $maintenance->save();

            $data_in = new MaintenaceBillLedger;
            $data_in->maintenace_bill_id = $maintenance->id;
            $data_in->payableamount = $service->amount;
            $data_in->receiving_amount = 0;
            $data_in->save();
        });
    }

    // protected function getDta($service): array
    // {
    //     $word = Terbilang::make($service->amount);
    //     // $emailsInfo = $service->to_information;
    //     // $emails = explode(',', $emailsInfo);

    //     $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");

    //     $dt = date('d M Y', strtotime($service->created_at));

    //     $data["name"] = 'BD accounts';
    //     $data["subject"] = "Maintenance charge for $service->software_name";
    //     $data["to_information"] = $service->to_information;
    //     $data["email"] = $service->from_information;
    //     $data["amount"] = $service->amount;
    //     $data["softwarename"] = 'Maintenance charge for '.$service->software_name;
    //     $data["address"] = $service->address;
    //     $data["client_name"] = $service->client_name;
    //     $data["client_code"] = 'IBS-'.$bill_no;
    //     $data["contact_person"] = $service->contact_person;
    //     $data["client_email"] = $service->email;
    //     $data["send_to"] = $service->send_to;
    //     $data["created_at"] = $dt;
    //     $data["word"] = $word;
    //     // $data["emailsinfo"] = $emails;

    //     return $data;
    // }
}
