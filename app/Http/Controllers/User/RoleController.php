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


class RoleController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    


 public function role()
    {


       return view('users.role.role');
    }



    public function role_list(){

        $role_lists = DB::select("SELECT id,name,guard_name from roles");
        return json_encode(array('data' => $role_lists));       
    }




  public function role_store(Request $request){
        

                     $validator = Validator::make($request->all(), [
                        'name'          => 'required|unique:roles',
                        'display_name'  => 'required',
                    ]);


                   if( $validator->fails() ){
                       return Response::json(array(
                           'success'   => false,
                           'messages'  => implode(",",$validator->getMessageBag()->all()),
                           // 'errors'    => $validator->getMessageBag()->toArray()
                       ));
                   } 


                   if(!empty($request->id)){
                      $id = $request->id;
                   }



                   DB::beginTransaction();
                        try {


                                if(!empty($request->id)){
                                   $role = Role::find($id);
                                }else{
                                    $role = new Role;
                                }
                                $role->name         =$request->name;
                                $role->guard_name   =$request->display_name;
                                $role->save();

                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollback();
                            return Redirect()->back()->withErrors($e->getMessage())->withInput();
                        }   
               

               

                  return response::json(array(
                       'success'   => true,
                       // 'id'        => Crypt::encrypt($insert_data->id),
                       'messages'  => 'Data has been successfully updated!'
                    ));

        
        
    
    }

      



}
