<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterSetting\Clients;
use App\Models\MasterSetting\Service;
use Illuminate\Support\Facades\Validator;

class ServiceConfiqController extends Controller
{
    public function index()
    {
        return view("MasterSetting.service.index");
    }

    public function getService()
    {
        $service  =  DB::SELECT("SELECT
            service_confiq.id,
            concat(client_information.client_name, coalesce(concat(' | ', client_information.client_code), '')) AS customer,
            service_confiq.to_information,service_confiq.from_information,service_confiq.software_name,service_confiq.amount,service_confiq.send_to,service_confiq.valid,
            CASE WHEN service_confiq.valid = 1 THEN 'Active' ELSE 'Inactive' END active_status
            FROM service_confiq
            JOIN
            client_information ON service_confiq.client_information_id = client_information.id");

        $services = collect($service);

        return Datatables::of($services)
            ->addColumn('Link', function ($services) {
                return ' <a href="'. url('services/'.encrypt($services->id).'/edit').'" class="class="btn btn-app"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="glyphicon-class"> Edit</span></a>';
            })
            ->rawColumns(['Link'])
            ->make(true);
    }

    public function create()
    {
        $clients=Clients::all();

        return view("MasterSetting.service.create", compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_information'             => 'nullable',
            'from_information'           => 'nullable',
            'software_name'              => 'nullable',
            'send_to'                    => 'nullable',
            'amount'                     => 'required',
            'client_id'                  => 'required|not_in:-- Select Client --'
        ]);

       if( $validator->fails() ){
            return back()->withErrors($validator)->withInput();
       }

        DB::beginTransaction();
        try {
            $insert_service  = new Service;
            $insert_service->to_information          = $request->to_information;
            $insert_service->from_information        = $request->from_information;
            $insert_service->software_name           = $request->software_name;
            $insert_service->amount                  = $request->amount;
            $insert_service->valid                   = 1;
            $insert_service->client_information_id   = $request->client_id;
            $insert_service->send_to                 = $request->send_to;
            $insert_service->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->to('/services')->with('alert-success', 'data has been successfully created..!');
    }

    public function edit($id)
    {
        $service  = Service::findOrFail(decrypt($id));

        $clients = Clients::all();

        return view('MasterSetting.service.edit', compact('service', 'clients'));
    }

    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'to_information'             => 'nullable',
            'from_information'           => 'nullable',
            'software_name'              => 'nullable',
            'send_to'                    => 'nullable',
            'amount'                     => 'required',
            'client_id'                  => 'required|not_in:-- Select Client --'
       ]);

       if( $validator->fails() ){
            return back()->withErrors($validator)->withInput();
       }

        DB::beginTransaction();
        try {

            $insert_service  = Service::find($id);
            $insert_service->to_information          = $request->to_information;
            $insert_service->from_information        = $request->from_information;
            $insert_service->software_name           = $request->software_name;
            $insert_service->amount                  = $request->amount;
            $insert_service->valid                   = $request->active_status;
            $insert_service->client_information_id   = $request->client_id;
            $insert_service->send_to                 = $request->send_to;
            $insert_service->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect()->back()->withErrors($e->getMessage())->withInput();
        }

        return redirect()->to('/services')->with('alert-success', 'data has been successfully update!');
    }

    public function reactive($id)
    {
        DB::update("UPDATE service_confiq SET valid = 1 WHERE id = $id");

       return redirect()->to('/services')->with('alert-success', 'data has been successfully update!');
    }

    public function cancel($id)
    {
        // $password = bcrypt('zax!1%$l:)^'.$id);
        DB::update("UPDATE service_confiq SET valid = 0 WHERE id = $id");

        return redirect()->to('/services')->with('alert-success', 'data has been successfully update!');
    }
}
