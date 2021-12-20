<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\MasterSetting\Service;
use App\Models\MasterSetting\MoneyReceipt;

class MoneyReceiptController extends Controller
{
    public function index()
    {
        return view('MasterSetting.money_receipt.index');
    }

    public function getData()
    {
        $money_receipt = DB::table('money_receipt as a')
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->select('a.*', 'b.client_name')
            ->selectRaw("
                date_format(a.date, '%d %b, %Y') as date
            ")
            ->get();

        return datatables()->of($money_receipt)
            ->addColumn('Link', function($money_receipt) {
                return '<a href="'. route('money_receipt.edit', encrypt($money_receipt->id)).'" class="btn btn-primary btn-sm btn-block"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                <a href="'. route('money_receipt.show', encrypt($money_receipt->id)).'" class="btn btn-success btn-sm btn-block"><span class="glyphicon glyphicon-eye-open"></span> View</a>';
            })
            ->rawColumns(['Link'])
            ->make(true);
    }

    public function create()
    {
        return view('MasterSetting.money_receipt.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_information_id' => 'required|integer|exists:client_information,id',
            'receipt_type' => 'required',
            'date' => 'required|date',
            'amount' => 'required',
            'charge_for' => 'required|string',
            'bank_name' => 'nullable|string|max:100',
            'check_no' => 'nullable|string|max:50',
        ]);

        try {
            $bill_no = Service::generate_tr_number("money_receipt", "receipt_no");

            MoneyReceipt::create(
                array_merge($data, ['receipt_no' => 'MR-'.$bill_no, 'users_id' => auth()->id()])
            );

            return redirect()->route('money_receipt.index')->with('message', 'Money receipt has been created..!!');
        } catch (\Exception $e) {
            return back()->with('message', $e->getMessage());
        }
    }

    public function show($id)
    {
        $money_receipt = $this->getSingleData(decrypt($id));

        return view('MasterSetting.money_receipt.show', compact('money_receipt'));
    }

    public function edit($id)
    {
        $money_receipt = $this->getSingleData(decrypt($id));

        return view('MasterSetting.money_receipt.edit', compact('money_receipt'));
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'client_information_id' => 'required|integer|exists:client_information,id',
            'receipt_type' => 'required',
            'date' => 'required|date',
            'amount' => 'required',
            'charge_for' => 'required|string',
            'bank_name' => 'nullable|string|max:100',
            'check_no' => 'nullable|string|max:50',
        ]);

        try {

            $money_receipt = MoneyReceipt::query()->findOrFail($id);

            $money_receipt->update(
                array_merge($data, ['users_id' => auth()->id()])
            );


            return redirect()->route('money_receipt.index')->with('message', 'Money receipt has been updated..!!');
        } catch (\Exception $e) {
            return back()->with('message', $e->getMessage());
        }
    }

    public function send($id, Request $request)
    {
        $money_receipt['money_receipt'] = $this->getSingleData(decrypt($id));

        $pdf = PDF::loadView('mails.money_receipt', $money_receipt);

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
                    ->attachData($pdf->output(), "money_receipt.pdf");
            });

            MoneyReceipt::query()
                ->findOrFail(decrypt($id))
                ->update(['is_send' => true]);

            return back()->with('message', 'Mail Send Successfully..!');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function getSingleData($id)
    {
        return DB::table('money_receipt as a')
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->select('a.*', 'b.client_name')
            ->where('a.id', $id)
            ->first();
    }
}
