<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
   public $timestamps   = true;

   protected $table = 'branchs';
   protected $primaryKey = 'id';
}