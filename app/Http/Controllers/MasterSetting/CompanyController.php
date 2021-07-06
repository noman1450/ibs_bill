<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use App\Models\MasterSetting\Company;
use Validator;
use Response;
use Redirect;
use Auth;
use DB;
use Entrust;
use Yajra\DataTables\DataTables;
use Crypt;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("MasterSetting.companys.index");
    }

    public function getCompany(){

 
        $company  =  DB::SELECT("SELECT * FROM company_infos ");

        $companys = collect($company);


   
        return Datatables::of($companys)
        ->addColumn('Link', function ($companys) {

            return ' <a href="'. url('companys') . '/' . Crypt::encrypt($companys->id) . '/edit' .'" ' .'class="class="btn btn-app"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span><span class="glyphicon-class"> Edit</span></a>';
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
        return view("MasterSetting.companys.create");
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
              'full_name'            => 'required',
            'short_name'            => 'required',
              'email'             => '  required|string|email|max:255|unique:company_infos',
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

            $insert_company  = new Company;
            $insert_company->full_name           = $request->full_name;
            $insert_company->short_name          = $request->short_name;
            $insert_company->address             = $request->address;
            $insert_company->email               = $request->email;
            $insert_company->contact_number      = $request->contact_number;
            $insert_company->reg_date            = $request->reg_date;
            $insert_company->web_address            = $request->web_address;
            $insert_company->valid               = 1;
            $insert_company->compay_type         = 1;
            $insert_company->save();


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect()->back()->withErrors($e->getMessage())->withInput();
        }     

       // $request->session()->flash('alert-success', 'data has been successfully added!');        
      //  return Redirect::to('companys'); 


       return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully update!'
        ));          
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
        $company  = Company::findOrFail(Crypt::decrypt($id));
        return view('MasterSetting.companys.edit', compact('company'));        
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
            'full_name'            => 'required',
            'short_name'            => 'required',
            'email'             => 'required|string|email|max:255',
            'address'           => 'required',
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

            $insert_company  = Company::find($id);
            $insert_company->full_name         = $request->full_name;
            $insert_company->short_name          = $request->short_name;
            $insert_company->address             = $request->address;
            $insert_company->email               = $request->email;
            $insert_company->contact_number      = $request->contact_number;
            $insert_company->reg_date            = $request->reg_date;
            $insert_company->web_address            = $request->web_address;
            $insert_company->valid               = 1;
            $insert_company->compay_type         = 1;
            $insert_company->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect()->back()->withErrors($e->getMessage())->withInput();
        }     

     //   $request->session()->flash('alert-success', 'data has been successfully update!');        
      //  return Redirect::to('companys');  

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
