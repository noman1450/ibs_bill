<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class MaintenaceBillLedger extends Model
{
   public $timestamps   = true;

   protected $table = 'maintenace_bill_ledger';
   protected $primaryKey = 'id';
}