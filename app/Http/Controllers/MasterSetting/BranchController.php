<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use App\Models\MasterSetting\Branch;
use App\Models\MasterSetting\Company;

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

class BranchController extends Controller
{
    public function index()
    {
        return view("MasterSetting.branch.index");
    }

    public function getBranch(){
                    $branch  =  DB::SELECT("SELECT
                    branchs.id,
                    CONCAT(branchs.branch_name,' | ',company_infos.full_name) AS branch,
                    branchs.address,
                    branchs.contact_number,branchs.email,
                    CASE WHEN branchs.valid = 1 THEN 'Active' ELSE 'Inactive' END active_status
                    FROM branchs
                    JOIN
                    company_infos ON branchs.company_infos_id = company_infos.id");



                    $branchs = collect($branch);
                    return Datatables::of($branchs)
                    ->addColumn('Link', function ($branchs) {
                    return ' <a href="'. url('branchs') . '/' . Crypt::encrypt($branchs->id) . '/edit' .'" ' .'class="class="btn btn-app"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="glyphicon-class"> Edit</span></a>';
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

         $companys=Company::all();
        return view("MasterSetting.branch.create",compact('companys'));
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
        'branch'            => 'required|string|max:255|unique:branchs,branch_name',
        'email'             => 'required|string|email|max:255|unique:branchs',
        'address'           => 'required',
        'contact_number'    => 'required',
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

            $insert_branch  = new Branch;
            $insert_branch->branch_name             = $request->branch;
            $insert_branch->address          = $request->address;
            $insert_branch->email                   = $request->email;
            $insert_branch->contact_number   = $request->contact_number;
            $insert_branch->valid                   = 1;
            $insert_branch->branch_type             = 1;
            $insert_branch->company_infos_id        = $request->company_id;
            $insert_branch->save();

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
        $branch  = Branch::findOrFail(Crypt::decrypt($id));
          $companys=Company::all();
        return view('MasterSetting.branch.edit', compact('branch','companys'));
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
            'branch'            => 'required|unique:branchs,branch_name,'.$id.',id',
             'email'             => 'required|string|email|max:255',
            'address'           => 'required',
            'contact_number'    => 'required',
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

            $insert_branch  = Branch::find($id);
            $insert_branch->branch_name             = $request->branch;
            $insert_branch->email                   = $request->email;
            $insert_branch->address                 = $request->address;
            $insert_branch->contact_number          = $request->contact_number;
            $insert_branch->valid                   = $request->active_status;
            $insert_branch->branch_type             = 1;
            $insert_branch->company_infos_id        = $request->company_id;
            $insert_branch->save();

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
}
