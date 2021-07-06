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

class RolePermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

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
        return view('users.role_permission.role_permission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    public function submit_role_permission(Request $request){
        // dd($request->permission);
        $permissions = $request->permission;
        DB::table('role_has_permissions')->truncate();
        foreach ($permissions as $permission ) {
            $temp           = explode(":", $permission);
            $role_id        = $temp[1];
            $permission_id  = $temp[0];
            //fetching the specific role with the id
            $role_query = Role::where('id', '=', $role_id)->first();
            //fetching the specific permission with the id
            $permission_query = Permission::where('id','=',$permission_id)->first();
            // $role_query->attachPermission($permission_query);
            $insert = new PermissionRole;
            $insert->permission_id = $permission_id;
            $insert->role_id       = $role_id;
            $insert->save();
        // dd($role_query);
        }

            return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Data has been successfully updated!'
        ));   
    }

    public function user_role_display(){
        $roles = DB::table('roles')->select('id','name')->get();
        $query_users = "
        SELECT 
        users.id AS user_id,
        users.name AS username,
        roles.id,
        roles.name 
        FROM users 
        LEFT JOIN 
        assigned_roles 
        ON users.id = assigned_roles.user_id
        LEFT JOIN roles
        ON 
        assigned_roles.role_id = roles.id
        ";
        $users = DB::select($query_users);
        // dd($user);
        return view('role_permission.user_role')->with('users',$users)->with('roles', $roles);        
    }

    public function submit_user_role($id){

        // dd($id);

        $user       = DB::table('users')->select('id','name','email')->where('id',$id)->first();
        // $all_roles  = DB::table('roles')->select('id','name')->get();
        
        $query_roles="SELECT 
                            roles.id AS role_id, roles.name AS role_name,assigned_roles.role_id as assigned_role_id
                        FROM
                            roles
                               LEFT JOIN
                            assigned_roles ON assigned_roles.user_id = '.$id.'
                                AND assigned_roles.role_id = roles.id";

        $roles=DB::select($query_roles);


        if(sizeof($roles)==0){
            return view('role_permission.user_role_create')
                ->with('user',$user);
                // ->with('all_roles',$all_roles);
        }else{
            return view('role_permission.user_role_create')
                    ->with('user',$user)
                    // ->with('all_roles',$all_roles)
                    ->with('roles',$roles);
        }        
    }

    public function add_user_role(Request $request){

        // dd($request->all());

        $roles = $request->role;
        $user  = User::where('id', $request->user_id)->first();

        DB::table('assigned_roles')->where('user_id', '=', $request->user_id)->delete();
        DB::table('role_user')->where('user_id', '=', $request->user_id)->delete();



        foreach ($roles as $role) {


            $insert = new AssignedRoles;
            $insert->role_id = $role;
            $insert->user_id = $request->user_id;
            $insert->save();


            $roleuser= new RoleUser;
            $roleuser->user_id         =$request->user_id;
            $roleuser->role_id         =$role;                           
            $roleuser->save();



        }




        $request->session()->flash('alert-success', 'role has been successfully added!');
        return redirect()->back();        
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
        //
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
        //
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
