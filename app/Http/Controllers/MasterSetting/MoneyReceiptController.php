<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\Service;
use App\Models\MasterSetting\MoneyReceipt;
use Illuminate\Support\Facades\DB;

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
                array_merge($data, ['receipt_no' => 'MR-'.$bill_no])
            );

            return redirect()->route('money_receipt.index')->with('message', 'Money receipt has been created..!!');
        } catch (\Exception $e) {
            return back()->with('message', $e->getMessage());
        }
    }

    public function show($id)
    {
        $money_receipt = DB::table('money_receipt as a')
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->select('a.*', 'b.client_name')
            ->where('a.id', decrypt($id))
            ->first();

        return view('MasterSetting.money_receipt.show', compact('money_receipt'));
    }

    public function edit($id)
    {
        $money_receipt = DB::table('money_receipt as a')
            ->join('client_information as b', 'a.client_information_id', '=', 'b.id')
            ->select('a.*', 'b.client_name')
            ->where('a.id', decrypt($id))
            ->first();

        // dd($money_receipt);

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

            $money_receipt->update($data);


            return redirect()->route('money_receipt.index')->with('message', 'Money receipt has been updated..!!');
        } catch (\Exception $e) {
            return back()->with('message', $e->getMessage());
        }
    }
}
