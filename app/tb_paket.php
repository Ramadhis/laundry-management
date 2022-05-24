<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_paket extends Model
{	
	use SoftDeletes;
    protected $table = 'tb_paket';
    protected $dates = ['deleted_at'];
    protected $fillable = ['id_outlet','jenis','nama_paket','harga'];
}
