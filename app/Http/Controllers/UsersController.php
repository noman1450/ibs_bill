<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Input;
use Validator;
use Redirect;
use Session;
use Response;
use Crypt;
use Config;
use App\User;
use App\Models\HrmUserLocation;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\AssignedRoles;


class UsersController extends Controller
{
    public function index()
    {
        return view('users.users_list');
    }

    public function userslocationlist(Request $request){

        $locationlist = DB::select("SELECT a.id,a.location_name,b.users_id,b.default_location FROM hrm_location a LEFT JOIN user_location b ON a.id=b.hrm_location_id AND a.valid=1 AND b.users_id=$request->user_id ");
        return json_encode(array('data' => $locationlist));
    }

    public function users_list()
    {
        $userslists = DB::select("SELECT
                                       * FROM users a
                                       GROUP BY a.id , a.name , a.email");

        return json_encode(array('data' => $userslists));
    }

    public function reset($id)
    {
        $user_data= DB::SELECT("SELECT id,name,email,designation FROM users WHERE id=$id");
        return view('users.reset_password')
            ->with('user_data',$user_data);
    }

    public function resetmypassword( )
    {
        $user_id=Auth::user()->id;

        $user_data= DB::SELECT("SELECT id,name,email,designation FROM users WHERE id=$user_id");
        return view('users.reset_password')
            ->with('user_data',$user_data);
    }

    public function password_reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password'          => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }

        $bcrypt= bcrypt($request->password);

        DB::update("UPDATE users SET password = '$bcrypt' WHERE id = $request->user_id");

        $request->session()->flash('alert-success', 'data has been successfully updated!');
        return Redirect::to('home');
    }

    public function create()
    {
        echo "hi";
        exit;
        $role_lists = DB::select("SELECT id,guard_name from roles");
        return view('users.create_users')
            ->with('role_list',$role_lists);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'          => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:6|confirmed',
        ]);

        if( $validator->fails() ){
            return Response::json(array(
                'success'   => false,
                'messages'  => implode(",",$validator->getMessageBag()->all()),
            ));
        }

        $check_data= DB::SELECT("SELECT id from users WHERE email='$request->email'");

        if(!empty($check_data)){
            return redirect('users/create');
        }

        DB::beginTransaction();
        try{
            $userdata = User::create([
                'name'              => $request->username,
                'email'             => $request->email,
                'password'          => bcrypt($request->password)
            ]);

            // dd($userdata);
            //Create User Location
            //  $count_row=count($request->permissionlocation);

            // if (!empty($count_row)){

            // foreach ($request->permissionlocation as $keys ) {

            //         $insert     = new HrmUserLocation;
            //         $insert->users_id          = $userdata->id;
            //         $insert->hrm_location_id   = $keys;
            //         $insert->default_location  = 0;
            //         $insert->save();
            // }

            // $defaultlocation=$request->defaultlocation[0];
            // DB::update("UPDATE user_location SET default_location = 1
            //              WHERE hrm_location_id = $defaultlocation and users_id=$userdata->id");


            //     }else{
            //             return redirect('users/create');
            // }

            //Create User Role

            // $roleuser= new RoleUser;
            // $roleuser->user_id         =$userdata->id;
            //$roleuser->role_id         =$request->userrole;
            // $roleuser->save();
            // dd($userdata->id);


            // $insert = new AssignedRoles;
            // $insert->user_id = $userdata->id;
            //   $insert->role_id = $request->userrole;
            // $insert->save();

            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            $validator->errors()->add('field', $e->getMessage());
            return response()->json($validator->errors()->all());
        }


        // $request->session()->flash('alert-success', 'data has been successfully added!');
        // return Redirect::to('users');


        return response::json(array(
            'success'   => true,
            // 'id'        => Crypt::encrypt($insert_data->id),
            'messages'  => 'Successfully insert!'
        ));
    }

    public function edit($id)
    {
        $userslists = DB::select("SELECT *
            FROM users ");

        $role_lists = DB::select("SELECT id,guard_name from roles");

        return view('users.edit_users')
            ->with('role_list',$role_lists)
            ->with('edit_data',$userslists);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username'          => 'required|string|max:255',
        ]);

        if( $validator->fails() ){
            return Response::json(array(
                'success'   => false,
                'messages'  => implode(",",$validator->getMessageBag()->all()),
                // 'errors'    => $validator->getMessageBag()->toArray()
            ));
        }

        DB::beginTransaction();
        try{

            // DB::table('user_location')->where('users_id', '=', $request->user_id)->delete();
            // DB::table('role_user')->where('user_id', '=', $request->user_id)->delete();
            // DB::table('assigned_roles')->where('user_id', '=', $request->user_id)->delete();


            //Create User Location
            // $count_row=count($request->permissionlocation);

            //  if (!empty($count_row)){

            //         foreach ($request->permissionlocation as $keys ) {

            //                 $insert     = new HrmUserLocation;
            //                 $insert->users_id          = $request->user_id;
            //                 $insert->hrm_location_id   = $keys;
            //                 $insert->default_location  = 0;
            //                 $insert->save();
            // }

            // $defaultlocation=$request->defaultlocation[0];
            // DB::update("UPDATE user_location SET default_location = 1
            //              WHERE hrm_location_id = $defaultlocation and users_id=$request->user_id");


            //     }else{
            //             return redirect('users/create');
            // }

            //Create User Role

            // $roleuser= new RoleUser;
            // $roleuser->user_id         =$request->user_id;
            // $roleuser->role_id         =$request->userrole;

            // $roleuser->save();


            // $insert = new AssignedRoles;
            // $insert->user_id = $request->user_id;
            // $insert->role_id = $request->userrole;
            // $insert->save();

            // dd("noman");
            // if($request->employee_name==null){
            //    $employee_id='null';
            // }else{
            //    $employee_id=$request->employee_name;
            // }

            DB::update("UPDATE users SET name= '$request->username',email='$request->email' WHERE id = $request->user_id");

            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            $validator->errors()->add('field', $e->getMessage());
            return response()->json($validator->errors()->all());
        }

        // $request->session()->flash('alert-success', 'data has been successfully updated!');
        // return Redirect::to('users');

        return response::json(array(
            'success'   => true,
            // 'id'        => Crypt::encrypt($insert_data->id),
            'messages'  => 'Successfully update!'
        ));
    }

    public function cancel($id)
    {
        $password = bcrypt('zax!1%$l:)^'.$id);
        DB::update("UPDATE users SET valid = 0,password='$password' WHERE id = $id");

        // DB::table('user_location')->where('users_id', '=', $id)->delete();
        // DB::table('role_user')->where('user_id', '=', $id)->delete();
        // DB::table('assigned_roles')->where('user_id', '=', $id)->delete();
        // DB::table('users')->where('id', '=', $id)->delete();
        // dd("NOMAN");

        session()->flash('alert-success', 'data has been successfully deleted!');
        return Redirect::to('users');
    }

    public function reactive($id)
    {
        DB::update("UPDATE users SET valid = 1 WHERE id = $id");

        // DB::table('user_location')->where('users_id', '=', $id)->delete();
        // DB::table('role_user')->where('user_id', '=', $id)->delete();
        // DB::table('assigned_roles')->where('user_id', '=', $id)->delete();
        // DB::table('users')->where('id', '=', $id)->delete();
        // dd("NOMAN");

        session()->flash('alert-success', 'data has been successfully deleted!');
        return Redirect::to('users');
    }

    public function role()
    {
        return view('users.role');
    }

    public function role_list()
    {
        $role_lists = DB::select("SELECT id,name,guard_name from roles");
        return json_encode(array('data' => $role_lists));
    }

    public function role_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'display_name'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('role')
                ->withErrors($validator)
                ->withInput();
        }

        $role= new Role;
        $role->name         =$request->name;
        $role->guard_name =$request->display_name;
        $role->save();

        $request->session()->flash('alert-success', 'data has been successfully added!');
        return redirect()->back();
    }
}
