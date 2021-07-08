<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
   protected $table = 'service_confiq';

   public static function generate_tr_number($table_name, $column_name): string
   {
       $search  = DB::select("SELECT MAX(RIGHT($column_name, 8)) As invno FROM $table_name ");

       $new_invoice_no = '';

       foreach ($search as $key) {
           $maxinvoiceno = $key->invno;
           $yearid = date("y");
           $monthid = date("m");
           $datevalue = $yearid . $monthid;
           $invoice_no = substr($maxinvoiceno, 0, 4);

           if ($maxinvoiceno == 0) {
               $a = "0001";
               $new_invoice_no = $yearid . $monthid . $a;
           } else {
               if ($invoice_no == $datevalue) {
                   $maxinvoiceno = substr($maxinvoiceno, 4) + 1;
                   $maxinvoiceno = sprintf("%04s\n", $maxinvoiceno);
                   $new_invoice_no = $datevalue . $maxinvoiceno;
               } else {
                   $a = "0001";
                   $new_invoice_no = $yearid . $monthid . $a;
               }
           }
       }

       return  trim($new_invoice_no);
   }
}
