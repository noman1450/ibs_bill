<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   public $timestamps   = true;

   protected $table = 'company_infos';
   protected $primaryKey = 'id';
}