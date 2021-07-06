<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use App\Models\MasterSetting\Service;
use App\Models\MasterSetting\Clients;

use Validator;
use Response;
use Redirect;
use Auth;
use DB;
use Entrust;
use Yajra\DataTables\DataTables;
use Crypt;
use App\Post;
use App\Http\Requests\PostRequest;

class ServiceConfiqController extends Controller
{
    public function index()
    {
        return view("MasterSetting.service.index");
    }

    public function getService(){
                    $service  =  DB::SELECT("SELECT
                    service_confiq.id,
                    CONCAT(client_information.client_name) AS customer,
                    service_confiq.to_information,service_confiq.from_information,service_confiq.software_name,service_confiq.amount,service_confiq.send_to,service_confiq.valid,
                    CASE WHEN service_confiq.valid = 1 THEN 'Active' ELSE 'Inactive' END active_status
                    FROM service_confiq
                    JOIN
                    client_information ON service_confiq.client_information_id = client_information.id");



                    $services = collect($service);
                    return Datatables::of($services)
                    ->addColumn('Link', function ($services) {
                    return ' <a href="'. url('services') . '/' . Crypt::encrypt($services->id) . '/edit' .'" ' .'class="class="btn btn-app"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="glyphicon-class"> Edit</span></a>';
                    })
                    ->editColumn('id', '{{$id}}')
                    ->setRowId('id')
                    ->rawColumns(['Link'])
                    ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $clients=Clients::all();
        return view("MasterSetting.service.create",compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $validator = Validator::make($request->all(), [
        'to_information'             => 'required',
        'from_information'           => 'required',
        'software_name'              => 'required',
        'send_to'                    => 'required',
        'amount'                     => 'required',
        ]);

       if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
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
            return Redirect()->back()->withErrors($e->getMessage())->withInput();
        }


        return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully insert!'
         //   'messages'  =>
        ));


         // return back(),



        // $request->session()->flash('alert-success', 'data has been successfully added!');
        // return Redirect::to('branchs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service  = Service::findOrFail(Crypt::decrypt($id));
          $clients=Clients::all();
        return view('MasterSetting.service.edit', compact('service','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


         $validator = Validator::make($request->all(), [
            'to_information'             => 'required',
            'from_information'           => 'required',
            'software_name'              => 'required',
            'send_to'                    => 'required',
            'amount'                     => 'required',
       ]);




       if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
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

        //$request->session()->flash('alert-success', 'data has been successfully update!');
       // return Redirect::to('branchs');

         return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully update!'

        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


         public function reactive($id)
    {

        DB::update("UPDATE service_confiq SET valid = 1 WHERE id = $id");

        // DB::table('user_location')->where('users_id', '=', $id)->delete();
        // DB::table('role_user')->where('user_id', '=', $id)->delete();
        // DB::table('assigned_roles')->where('user_id', '=', $id)->delete();
        // DB::table('users')->where('id', '=', $id)->delete();
        // dd("NOMAN");


       session()->flash('alert-success', 'data has been successfully update!');
       return Redirect::to('services');
    }



 public function cancel($id)
    {

        $password = bcrypt('zax!1%$l:)^'.$id);
        DB::update("UPDATE service_confiq SET valid = 0 WHERE id = $id");

        // DB::table('user_location')->where('users_id', '=', $id)->delete();
        // DB::table('role_user')->where('user_id', '=', $id)->delete();
        // DB::table('assigned_roles')->where('user_id', '=', $id)->delete();
        // DB::table('users')->where('id', '=', $id)->delete();
        // dd("NOMAN");


       session()->flash('alert-success', 'data has been successfully deleted!');
       return Redirect::to('services');
    }
}
