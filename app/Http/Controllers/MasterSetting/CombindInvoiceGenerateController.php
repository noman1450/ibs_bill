<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterSetting\Service;

class CombindInvoiceGenerateController extends Controller
{
    public function index()
    {
        $months = DB::table('month')->get();

        return view('MasterSetting.combined_invoice.index', compact('months'));
    }

    public function getData(Request $request)
    {
        $condition = '';

        if ($request->client_information_id) {
            $condition = " and b.client_information_id = $request->client_information_id";
        }

        $month_id = implode(',', $request->month_id ?? [0]);

        $data = DB::select("
            select
                b.id,
                a.id as maintenace_bill_ledger_id,
                concat(c.client_name, coalesce(concat(' | ', c.client_code), '')) as customer,

                c.email as to_information,
                c.from_email as from_information,
                c.cc_email,
                a.software_name,
                b.send_to,

                a.payableamount as amount,
                b.bill_no,
                date_format(b.created_at, '%d %b, %Y') as created_at,
                concat_ws(' | ', d.name, b.year_id) as month_year
            from
            maintenace_bill_ledger as a
                join
            maintenace_bill as b on a.maintenace_bill_id = b.id
                join
            client_information as c on b.client_information_id = c.id
                join
            month as d on b.month_id = d.id
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
                b.client_code,
                b.client_name,
                b.address as client_address,
                b.from_email,
                b.email as customer_email,
                b.cc_email,
                a.send_to,
                a.vat,
                a.is_apply_vat
            ")
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->where('b.id', $request->client_id)
            ->where('a.month_id', $request->month)
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

        if ($request->send_or_view === 'view') {
            return $pdf->stream('combined_bill.pdf');
        }
        elseif ($request->send_or_view === 'send') {
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
                        ->attachData($pdf->output(), "combined_bill.pdf");
                });

                return back()->with('message', 'Mail Send Successfully..!');
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
    }
}
