<?php

namespace App\Http\Controllers\MasterSetting;

use App\Http\Controllers\Controller;
use App\Models\MasterSetting\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerInformationController extends Controller
{
    public function index()
    {
        return view('MasterSetting.customer.index');
    }

    public function getData()
    {
        $customer = DB::table('client_information')
            ->selectRaw("
                id, client_name, client_code, email, address, contact_person,
                if(activity = 1, 'Active', 'Inactive') as activity
            ");

        return datatables()->of($customer)
            ->addColumn('Link', function($customer) {
                return ' <a href="'. url('customer_information').'/'.encrypt($customer->id).'/edit'.'" class="class="btn btn-app"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="glyphicon-class"> Edit</span></a>';
            })
            ->rawColumns(['Link'])
            ->make(true);
    }

    public function create()
    {
        return view('MasterSetting.customer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_code' => 'nullable|string|max:45',
            'email' => 'nullable|string|email|max:45',
            'address' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $mergeData = array_merge($data, [ 'activity' => 1, 'user_id' => auth()->id() ]);

            Clients::create($mergeData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('customer_information.index');
    }

    public function edit($id)
    {
        $customer = Clients::query()->findOrFail(decrypt($id));

        return view('MasterSetting.customer.edit', compact('customer'));
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_code' => 'nullable|string|max:45',
            'email' => 'nullable|string|email|max:45',
            'address' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $mergeData = array_merge($data, [ 'activity' => $request->active_status, 'user_id' => auth()->id() ]);

            $customer = Clients::query()->findOrFail($id);

            $customer->update($mergeData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->route('customer_information.index');
    }

    public function delete($id)
    {
        //
    }
}
