<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterSetting\Service;
use App\Models\MasterSetting\Maintenace;
use App\Models\MasterSetting\MaintenaceBillLedger;

class ProcessServiceController extends Controller
{
    public function index()
    {
        $months = DB::table('month')->get();

        return view('MasterSetting.process_service.index', compact('months'));
    }

    public function getData(Request $request)
    {
        $condition = '';

        if ($request->client_information_id) {
            $condition = " and a.client_information_id = $request->client_information_id";
        }

        $data = DB::select("
            select
                a.id,
                a.send_to,
                a.mail_count,
                a.bill_no,
                b.id as maintenace_bill_ledger_id,
                b.software_name,
                b.payableamount as  amount,
                b.service_confiq_id,
                c.client_name as customer,

                c.email as to_information,
                c.cc_email,
                c.from_email as from_information,

                date_format(a.created_at, '%d %b, %Y') as created_at,
                concat_ws(' | ', d.name, a.year_id) as month_year

                from
            maintenace_bill as a
                join
            maintenace_bill_ledger b on a.id = b.maintenace_bill_id
                join
            client_information as c on a.client_information_id = c.id
                join
            month as d on a.month_id = d.id
                where
                    a.year_id = $request->year_id
                and
                    a.month_id = $request->month_id
                $condition
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
                b.client_name,
                b.address as client_address
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

        return view('MasterSetting.process_service.view', $data);
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
                b.client_name,
                b.address as client_address
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

        $pdf = PDF::loadView('mails.pdf', $data);

        return $pdf->stream('invoice.pdf');
    }

    public function store(Request $request)
    {
        $condition = '';

        if ($request->client_information_id) {
            $condition = " and a.client_information_id = $request->client_information_id";
        }

        $services = DB::select("
            select
                a.id, a.from_information, c.client_name, c.address as client_address,
                c.email as client_email, a.software_name, a.send_to, a.amount,
                c.id as client_information_id
            from
                service_confiq as a
                join
                client_information as c on c.id = a.client_information_id and c.activity = 1
                where a.id not in (
                    select a.service_confiq_id from maintenace_bill_ledger a JOIN maintenace_bill b ON a.maintenace_bill_id=b.id
                    where b.year_id = $request->year and b.month_id = $request->month
                )
                $condition
        ");

        // dd($services);

        if (empty($services)) {
            $success = false;
            $message = "Data already exists...!";
        } else {
            $CheckClients_id = 0;
            foreach ($services as  $service) {
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

        return view('MasterSetting.process_service.edit', compact('maintenance', 'maintenanceLedger'));
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

    public function send_mail(Request $request)
    {
        $data['data'] = DB::table('maintenace_bill as a')
            ->join('client_information as b', 'b.id', '=', 'a.client_information_id')
            ->selectRaw("
                a.id,
                a.send_to,
                a.bill_no,
                a.created_at,
                b.client_name,
                b.address as client_address,
                b.from_email,
                b.email as customer_email,
                b.cc_email
            ")
            ->where('a.id', $request->maintenace_bill_id)
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
            ->where('a.id', $request->maintenace_bill_id)
            ->get();

        $pdf = PDF::loadView('mails.pdf', $data);

        $mailData['to_email'] = $request->to_email;
        $mailData['from_email'] = $request->from_email;
        $mailData['sender_name'] = $request->sender_name;
        if (!empty($request->cc_email)) {
            $mailData['cc_email'] = $request->cc_email;
        }
        $mailData["subject"] = $request->subject;
        $mailData["body"] = $request->body;

        try {

            Mail::send('mails.mail', $mailData, function($message) use ($mailData, $pdf) {
                if (!empty($mailData['cc_email'])) {
                    $message->cc($mailData['cc_email']);
                }

                $message
                    ->from($mailData["from_email"], $mailData['sender_name'])
                    ->to($mailData['to_email'])
                    ->subject($mailData["subject"])
                    ->attachData($pdf->output(), "invoice.pdf");
            });

            DB::table('maintenace_bill')
                ->where('id', $request->maintenace_bill_id)
                ->increment('mail_count');

            return back()->with('message', 'Mail Send Successfully..!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
