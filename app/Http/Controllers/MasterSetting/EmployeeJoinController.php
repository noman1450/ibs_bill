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
            select
                a.id,
                a.send_to,
                a.bill_no,
                b.id as maintenace_bill_ledger_id,
                b.software_name,
                b.payableamount as  amount,
                b.service_confiq_id,
                e.client_name as customer,
                c.to_information,
                c.from_information,
                date_format(a.created_at, '%d %b, %Y') as created_at,
                concat_ws(' | ', d.name, a.year_id) as month_year

                from
            maintenace_bill as a
                join
            maintenace_bill_ledger b on a.id = b.maintenace_bill_id
                join
            service_confiq as c on b.service_confiq_id = c.id and c.valid = 1
                join
            month as d on a.month_id = d.id
                join
            client_information as e on c.client_information_id = e.id
                where
                    a.year_id = $request->year_id
                and
                    a.month_id = $request->month_id
        ");

        return datatables()->of($data)
            ->make(true);
    }

    public function view($id)
    {
        $data['data'] = DB::table('maintenace_bill as a')
            ->join('client_information as b', 'b.id', '=', 'a.client_information_id')
            ->selectRaw("
                a.id,
                a.send_to,
                a.bill_no,
                a.created_at,
                b.client_name
            ")
            ->where('a.id', $id)
            ->first();

        $data['details'] = DB::table('maintenace_bill as a')
            ->join('maintenace_bill_ledger as b', 'b.maintenace_bill_id', '=', 'a.id')
            ->join('month as c', 'a.month_id', '=', 'c.id')
            ->selectRaw("
                a.id,
                b.payableamount as amount,
                b.software_name,
                concat_ws(' - ', c.name, a.year_id) as month_year
            ")
            ->where('a.id', $id)
            ->get();

        // dd($data);

        return view('MasterSetting.join_employee.view', $data);
    }

    public function show($id)
    {
        $data['data'] = DB::table('maintenace_bill as a')
            ->join('client_information as b', 'b.id', '=', 'a.client_information_id')
            ->selectRaw("
                a.id,
                a.send_to,
                a.bill_no,
                a.created_at,
                b.client_name
            ")
            ->where('a.id', $id)
            ->first();

        $data['details'] = DB::table('maintenace_bill as a')
            ->join('maintenace_bill_ledger as b', 'b.maintenace_bill_id', '=', 'a.id')
            ->join('month as c', 'a.month_id', '=', 'c.id')
            ->selectRaw("
                a.id,
                b.payableamount as amount,
                b.software_name,
                concat_ws(' - ', c.name, a.year_id) as month_year
            ")
            ->where('a.id', $id)
            ->get();

        // dd($data);

        // SendMailToClientJob::dispatch($data);

        $pdf = PDF::loadView('mails.pdf', $data);

        return $pdf->stream('invoice.pdf');
    }

    public function store(Request $request)
    {
        $services = DB::select("
            select
                a.id, a.from_information, c.client_name, c.address as client_address,
                c.email as client_email, a.software_name, a.send_to, a.amount,
                c.id as client_information_id
            from
                service_confiq as a
                join
                client_information as c on c.id = a.client_information_id
                where a.id not in (
                    select a.service_confiq_id from maintenace_bill_ledger a JOIN maintenace_bill b ON a.maintenace_bill_id=b.id
                    where b.year_id = $request->year and b.month_id = $request->month
                    )
        ");

        if (empty($services)) {
            $success = false;
            $message = "Data already exists...!";
        } else {
            $CheckClients_id = 0;
            foreach ($services as  $service) {
                // $this->fillOtherTable($request, $service);
                if($CheckClients_id!=$service->client_information_id) {
                    $CheckClients_id = 0;
                }

                if ($CheckClients_id === 0) {
                    $bill_no = Service::generate_tr_number("maintenace_bill", "bill_no");
                    $maintenance = new Maintenace;

                    $maintenance->client_information_id = $service->client_information_id;
                    $maintenance->year_id = $request->year;
                    $maintenance->month_id = $request->month;
                    $maintenance->bill_no = 'IBS-'.$bill_no;
                    $maintenance->send_to = $service->send_to;
                    $maintenance->save();

                    $CheckClients_id = $service->client_information_id;
                };

                $data_in = new MaintenaceBillLedger;
                $data_in->service_confiq_id = $service->id;
                $data_in->maintenace_bill_id = $maintenance->id;
                $data_in->payableamount = $service->amount;
                $data_in->receiving_amount = 0;
                $data_in->software_name = $service->software_name;
                $data_in->save();
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
        $maintenanceLedger = MaintenaceBillLedger::query()->findOrFail($id);

        $maintenance = Maintenace::query()->firstWhere('id', $maintenanceLedger->maintenace_bill_id);

        return view('MasterSetting.join_employee.edit', compact('maintenance', 'maintenanceLedger'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'bill_no' => 'required',
            'created_at' => 'required',
            'send_to' => 'required',
            'payableamount' => 'required',
            'software_name' => 'required',
        ]);

        $maintenanceLedger = MaintenaceBillLedger::query()->findOrFail($id);

        $maintenanceLedger->update([
            'payableamount' => $request->payableamount,
            'software_name' => $request->software_name,
        ]);

        $maintenance = Maintenace::query()
            ->firstWhere('id', $maintenanceLedger->maintenace_bill_id);

        $maintenance->update([
            'bill_no' => $request->bill_no,
            'created_at' => $request->created_at,
            'send_to' => $request->send_to,
        ]);

        return redirect()->to('/process_service');
    }

    protected function fillOtherTable($request, $service)
    {

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
