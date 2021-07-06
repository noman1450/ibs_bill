<?php

namespace App\Http\Controllers\MasterSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

use App\Models\MasterSetting\Service;
use App\Models\MasterSetting\Clients;
use App\Models\MasterSetting\Maintenace;
use App\Models\MasterSetting\MaintenaceBillLedger;

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
use DateTime;
use PDF;
use Mail;
use Terbilang;
use App\Mail\SendMail;

class DueCollectionController extends Controller
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



    public function cllientdueinfo()
    {
        $user_id = Auth::user()->id;
        $customer = DB::select("SELECT s.id,s.from_information,s.software_name,s.send_to,c.client_name FROM service_confiq s JOIN client_information c ON c.id=s.client_information_id");

        return view('MasterSetting.duecollection.duecollection')
        -> with('customer',  $customer) ;
    }





    public function customer_name_list(Request $request){


        $data   = DB::select("SELECT 
                                    id,
                                    client_name AS text
                       
                                FROM
                                    client_information 
                                WHERE
                                    client_name Like '%$request->term%';");

 return response()->json($data);

    }


     public function client_information_data_list(Request $request){


        $data   = DB::select("SELECT 
                                    s.id,
                                    CONCAT(c.client_name) AS customer,
                                    s.to_information,
                                    s.from_information,
                                    s.software_name,
                                    s.valid,
                                    s.send_to,
                                    s.amount
                                FROM
                                    service_confiq s
                                        JOIN
                                    client_information c ON s.client_information_id = c.id
                                        AND s.valid = 1  JOIN
                                    maintenace_bill m ON m.service_confiq_id = s.id");


        return json_encode(array('data' => $data)); 

    }




 public function submitemployeeidcard(Request $request)
    {



       
   
        $count_row  = count($request->id);

        for($r = 0; $r <$count_row; $r++) {

            $service_confiq_id            = $request->id[$r];
         
    
            $code = Service::leftjoin('client_information as c','c.id','=','service_confiq.client_information_id')
            ->select('c.address','c.client_name','c.client_code','c.contact_person','c.email','c.created_at','service_confiq.id','service_confiq.to_information','service_confiq.from_information','service_confiq.software_name','service_confiq.send_to','service_confiq.amount')
            ->where('service_confiq.id', $service_confiq_id)->first(); 





            if (empty($code)){
               $request->session()->flash('alert-danger', 'Please Check This List,Some Employees has no finger code!');        
               return Redirect()->back();    
            }


         

        

        try{

 
       $word =Terbilang::make($code->amount); 
       $emailsInfo = $code->to_information;
       $emails     = explode(',',$emailsInfo);

  
        $bill_no = $this->generate_tr_number("maintenace_bill","bill_no");


        $insert_in     = new Maintenace;
        $insert_in->service_confiq_id              = $service_confiq_id;
        $insert_in->year_id                        = $request->year;
        $insert_in->month_id                       = $request->month;
        $insert_in->bill_no                        = 'IBS-'.$bill_no;
        $insert_in->amount                         = $code->amount;
        $insert_in->send_to                        =  $code->send_to;
        $insert_in->save();
        $insertedId = $insert_in->id;


        $dt=$code->created_at->toFormattedDateString(); 

        $data["name"]='BD accounts';
        $data["subject"]="Maintenace charge for $code->software_name";
        $data["to_information"]= $code->to_information;
        $data["email"]=$code->from_information;
        $data["amount"]=$code->amount;
        $data["softwarename"]= 'Maintenace charge for '.$code->software_name;
        $data["address"]= $code->address;
        $data["client_name"]=  $code->client_name;
        $data["client_code"]= 'IBS-'.$bill_no;
        $data["contact_person"]= $code->contact_person;
        $data["client_email"]=$code->email;
        $data["send_to"]=  $code->send_to;
        $data["created_at"]=  $dt;
        $data["word"]=  $word;
        $data["emailsinfo"]=  $emails;

     


       $pdf = PDF::loadView('mails.pdf',$data);


    
            Mail::send('mails.mail', $data, function($message)use($data,$pdf) {
            $message->to($data['emailsinfo'], $data["email"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }


      



        $data_in     = new MaintenaceBillLedger;
        $data_in->maintenace_bill_id              = $insertedId;
        $data_in->payableamount                   = $code->amount;
        $data_in->receiving_amount                = 0;
        $data_in->save();
      


          if (Mail::failures()) {
            
               return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully update!'

        ));

        }




        }

         return response::json(array(
           'success'   => true,
           // 'id'        => Crypt::encrypt($insert_data->id),
           'messages'  => 'Successfully update!'

        ));

    }



     function generate_tr_number($table_name, $column_name){



        $search  = DB::select("SELECT MAX(RIGHT($column_name,8)) As invno FROM $table_name ");
        


        foreach ($search as $key)
            $maxinvoiceno = $key->invno;
        // var_dump($maxinvoiceno);
        // die("try");
        $yearid     = date("y");
        $monthid    = date("m");
        $datevalue  = $yearid . $monthid;
        $invoice_no = substr($maxinvoiceno, 0,4);

        if ($maxinvoiceno==0){

            $a = "0001";
            $new_invoice_no = $yearid . $monthid . $a;
        } else {
            if ($invoice_no==$datevalue){

                $maxinvoiceno = substr($maxinvoiceno, 4) + 1;
                $maxinvoiceno = sprintf("%04s\n", $maxinvoiceno);
                $new_invoice_no = $datevalue . $maxinvoiceno;
            } else {

                $a = "0001";
                $new_invoice_no = $yearid . $monthid . $a;    

            }
        }



        return  trim($new_invoice_no);
    }





}
