<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Redirect;
use Auth;
use DB;
use DataTables;
use Crypt;
use Response;
use Validator;
use Config;
use Session;
use Entrust;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\PermissionRole;
use App\Models\AssignedRoles;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("users.permission.permissionlist");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.permission.permission");
    }

    public function getpermissionlist(){
        $view_data = DB::select("SELECT 
                                     id,name,display_name
                                FROM 
                                    permissions  WHERE permissions.isActive=1 ");


        $reservation_data   = collect($view_data);
        return DataTables::of($reservation_data)
        ->setRowId('id')
        ->make(true);        
    }


    public function role_permission_display(){

        // $permission = DB::select("SELECT 
        //             permissions.id,
        //             permissions.display_name,
        //             permission_role.permission_id AS permission_id,
        //             permission_role.role_id AS role_id
        //         FROM
        //             permissions
        //                 LEFT JOIN
        //             permission_role ON permission_role.permission_id = permissions.id
        //             WHERE permissions.isActive=1 ;");
        
        // $all_permission = Permission::all();
        // $all_roles = Role::all();
        return view('users.permission.role_permission');
    }


      public function store(Request $request)
    {
        

        $validator = Validator::make($request->all(), [    
            'permission_name'  => 'required|unique:permissions,name',
            'display_name'     => 'required'
        ]);           

        if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
       } 

        $permission                 = new Permission;
        $permission->name           = $request->permission_name;
        $permission->display_name   = $request->display_name;
        $permission->isActive       = 1;
        $permission->save();

        // $request->session()->flash('alert-success', 'data has been successfully added!');        
        // return Redirect::to('permission');

         return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Data has been successfully updated!'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

 
}
