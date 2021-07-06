<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class Maintenace extends Model
{
   public $timestamps   = true;

   protected $table = 'maintenace_bill';
   protected $primaryKey = 'id';
}