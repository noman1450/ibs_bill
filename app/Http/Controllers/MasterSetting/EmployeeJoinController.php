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
    public function employeeidcard()
    {
        return view('MasterSetting.join_employee.employeeidcard');
    }

    public function employeeidcardlistdata(Request $request)
    {
        // dd($request->all());

        $month_id = implode(',', $request->month_id);

        $data = DB::select("
            select s.id, CONCAT(c.client_name) AS customer, s.to_information, s.from_information,
                   s.software_name, s.valid, s.send_to, s.amount
                from
            service_confiq s
                join
            client_information c on s.client_information_id = c.id
                and s.valid = 1
                and s.id not in (
                    select service_confiq_id
                        from
                    maintenace_bill
                        where
                            year_id = $request->year_id
                        and
                            month_id in($month_id)
                    )

                where s.client_information_id = $request->client_information_id
        ");

        // dd($data);

        return response()->json(['data' => $data]);
    }

    public function view($id, Request $request)
    {
        $data['data'] = DB::table('service_confiq as a')
            ->leftJoin('client_information as c', 'c.id', '=', 'a.client_information_id')
            ->selectRaw('
                a.id,
                date_format(c.created_at, "%M %d, %Y") as date,
                a.from_information,
                c.client_name,
                c.address as client_address,
                c.email as client_email,
                a.software_name, a.send_to, a.amount
            ')
            ->where('a.id', $id)
            ->first();

        $data['bill_no'] = Service::generate_tr_number("maintenace_bill", "bill_no");

        $data['word'] = Terbilang::make($data['data']->amount);

        // dd($data);

        return view('MasterSetting.join_employee.view', $data);
    }

    public function submitemployeeidcard($id, Request $request)
    {
        // if (empty($request->ids)) {
        //     return back()->with('alert-danger', 'Please Check This List,Some Employees has no finger code!');
        // }

        $data['data'] = DB::table('service_confiq as a')
            ->leftJoin('client_information as c', 'c.id', '=', 'a.client_information_id')
            ->selectRaw('
                a.id,
                a.from_information,
                c.client_name,
                c.address as client_address,
                c.email as client_email,
                a.software_name, a.send_to, a.amount
            ')
            ->where('a.id', $id)
            ->first();

        // SendMailToClientJob::dispatch($data);

        $this->fillOtherTable($request, $data['data']);

        // $data = $this->getDta($sendMailToClients);

        $data['bill_no'] = Service::generate_tr_number("maintenace_bill", "bill_no");

        $data['word'] = Terbilang::make($data['data']->amount);

        $pdf = PDF::loadView('mails.pdf', $data);

        return $pdf->stream('invoice.pdf');

        // return response()->json([
        //     'success'   => true,
        //     'messages'  => 'Successfully update!'
        // ]);
    }

    protected function fillOtherTable($request, $service)
    {
        // foreach ($sendMailToClients as $service) {

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
        // }
    }

    protected function generatePdf($sendMailToClients)
    {
        // foreach($sendMailToClients as $service) {
            $data = $this->getDta($sendMailToClients);

            $pdf = PDF::loadView('mails.pdf', $data);

            return $pdf->stream();
        // }
    }

    protected function getDta($service): array
    {
        $word = Terbilang::make($service->amount);
        // $emailsInfo = $service->to_information;
        // $emails = explode(',', $emailsInfo);

        $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");

        $dt = date('d M Y', strtotime($service->created_at));

        $data["name"] = 'BD accounts';
        $data["subject"] = "Maintenance charge for $service->software_name";
        $data["to_information"] = $service->to_information;
        $data["email"] = $service->from_information;
        $data["amount"] = $service->amount;
        $data["softwarename"] = 'Maintenance charge for '.$service->software_name;
        $data["address"] = $service->address;
        $data["client_name"] = $service->client_name;
        $data["client_code"] = 'IBS-'.$bill_no;
        $data["contact_person"] = $service->contact_person;
        $data["client_email"] = $service->email;
        $data["send_to"] = $service->send_to;
        $data["created_at"] = $dt;
        $data["word"] = $word;
        // $data["emailsinfo"] = $emails;

        return $data;
    }
}
