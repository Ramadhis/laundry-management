<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tb_outlet extends Model
{
   use SoftDeletes;
   protected $table = "tb_outlet";
   protected $fillable = ['nama','alamat','tlp'];
}
