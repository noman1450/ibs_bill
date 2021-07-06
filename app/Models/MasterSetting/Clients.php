<?php

namespace App\Models\MasterSetting;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
   public $timestamps   = true;

   protected $table = 'client_information';
   protected $primaryKey = 'id';
}