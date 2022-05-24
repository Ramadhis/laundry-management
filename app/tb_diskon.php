<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_diskon extends Model
{
   use SoftDeletes;
   protected $table = "tb_diskon";
   protected $fillable = ['nama','persen','keterangan','tanggal_mulai','tanggal_berakhir'];
}
