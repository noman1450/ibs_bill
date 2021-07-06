<?php

namespace App\Http\Controllers\User;

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

    function __construct(){
        $this->middleware('auth');
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
  

      return view('users.users.index');
    }




    public function userslocationlist(Request $request){
 
        $locationlist = DB::select("SELECT a.id,a.location_name,b.users_id,b.default_location FROM hrm_location a LEFT JOIN user_location b ON a.id=b.hrm_location_id AND a.valid=1 AND b.users_id=$request->user_id ");
        return json_encode(array('data' => $locationlist));       
    }


    public function users_list(){



        // $userslists = DB::select("SELECT 
        //                                 a.id,
        //                                 a.name,
        //                                 a.email,
        //                                 GROUP_CONCAT(e.guard_name) AS guard_name,
        //                                 IF('Active','Deactive') as status,
        //                                FROM
        //                                 users a
        //                                JOIN
        //                                 role_user d ON a.id = d.user_id
        //                                     JOIN
        //                                 roles e ON e.id = d.role_id
        //                             GROUP BY a.id , a.name , a.email");


                                       $userslists = DB::select("SELECT 
                                       * FROM users a
                                       GROUP BY a.id , a.name , a.email");



      //  $userslists=User::all();


        return json_encode(array('data' => $userslists));       
    }



    public function reset($id){

          $user_data= DB::SELECT("SELECT id,name,email FROM users WHERE id=$id");
          return view('users.reset_password')
          ->with('user_data',$user_data);

          // return view('auth.passwords.reset');      
    }

    public function resetmypassword( ){
          $user_id=Auth::user()->id;
          
          $user_data= DB::SELECT("SELECT id,name,email,designation FROM users WHERE id=$user_id");
          return view('users.reset_password')
          ->with('user_data',$user_data);

          // return view('auth.passwords.reset');      
    }



    public function password_reset(Request $request){

    

        $validator = Validator::make($request->all(), [
            'password'          => 'required|string|min:6|confirmed',
        ]);

     if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
       } 

         $bcrypt= bcrypt($request->password);
         
         DB::update("UPDATE users SET password = '$bcrypt' WHERE id = $request->user_id");
       

       // $request->session()->flash('alert-success', 'data has been successfully updated!');        
       //return Redirect::to('home'); 
          return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Data has been successfully updated!'
        ));
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
      $role_lists = DB::select("SELECT id,guard_name from roles"); 
       return view('users.users.create')
        ->with('role_list',$role_lists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// dd($request->all());
       
        $validator = Validator::make($request->all(), [
            'username'          => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:6|confirmed',
        ]);


       if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
       } 

        $check_data= DB::SELECT("SELECT id from users WHERE email='$request->email'");
        
        if(!empty($check_data)){
            return redirect('users/create');
        }


        DB::beginTransaction();
                    try{

                    //Create UserName

                            $userdata = User::create([
                                'name'              => $request->username,
                                'email'             => $request->email,
                                
                                'password'          => bcrypt($request->password)
                                // 'hrm_employee_id'   => $request->employee_name,

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
      


        $userslists = DB::select("SELECT *
            FROM users ");

       
       $role_lists = DB::select("SELECT id,guard_name from roles");
       
       $form_type='edit';

       return view('users.users.edit')
        ->with('role_list',$role_lists)
        ->with('form_type',$form_type)
        ->with('edit_data',$userslists);
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
     
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'username'          => 'required|string|max:255',
            'email'          => 'required',
        ]);

      

       if( $validator->fails() ){
           return Response::json(array(
               'success'   => false,
               'messages'  => implode(",",$validator->getMessageBag()->all()),
               // 'errors'    => $validator->getMessageBag()->toArray()
           ));
       } 
 
    // dd($request->all());

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




 

      



}
