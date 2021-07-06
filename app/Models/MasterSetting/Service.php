<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   public $timestamps   = true;

   protected $table = 'service_confiq';
   protected $primaryKey = 'id';
}