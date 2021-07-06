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

class AssignedRoleController extends Controller
{
    public function user_role_display()
    {
        $roles = DB::table('roles')->select('id','name')->get();
        $query_users = "SELECT
                            users.id AS users_id,
                            users.name AS username,
                            GROUP_CONCAT(roles.name) as name
                        FROM
                            users
                                LEFT JOIN
                            assigned_roles ON users.id = assigned_roles.users_id
                                LEFT JOIN
                            roles ON assigned_roles.roles_id = roles.id
                                GROUP BY users.id";
        $users = DB::select($query_users);
        // dd($user);
        return view('users.assigned_roles.user_role')->with('users',$users)->with('roles', $roles);
    }

    public function submit_user_role($id)
    {
        $user       = DB::table('users')->select('id','name','email')->where('id',$id)->first();

        $query_roles="SELECT
                            roles.id AS roles_id, roles.name AS role_name,assigned_roles.roles_id as assigned_roles_id
                        FROM
                            roles
                               LEFT JOIN
                            assigned_roles ON assigned_roles.users_id = '.$id.'
                                AND assigned_roles.roles_id = roles.id";

        $roles=DB::select($query_roles);

        if(sizeof($roles)==0) {
            return view('users.assigned_roles.user_role_create')
                ->with('user',$user);
            // ->with('all_roles',$all_roles);
        } else {
            return view('users.assigned_roles.user_role_create')
                ->with('user',$user)
                // ->with('all_roles',$all_roles)
                ->with('roles',$roles);
        }
    }

    public function add_user_role(Request $request){

        // dd($request->all());

        $roles = $request->role;
        $user  = User::where('id', $request->users_id)->first();

        DB::table('assigned_roles')->where('users_id', '=', $request->users_id)->delete();
        //   DB::table('role_user')->where('user_id', '=', $request->user_id)->delete();



        foreach ($roles as $role) {


            $insert = new AssignedRoles;
            $insert->roles_id = $role;
            $insert->users_id = $request->users_id;
            $insert->save();


            // $roleuser= new RoleUser;
            // $roleuser->user_id         =$request->user_id;
            // $roleuser->role_id         =$role;
            // $roleuser->save();



        }



        return response::json(array(
            'success'   => true,
            // 'id'        => Crypt::encrypt($insert_data->id),
            'messages'  => 'Data has been successfully updated!'
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
