<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_detail_trasaksi extends Model
{
	use SoftDeletes;
    protected $table = 'tb_detail_transaksi';
	protected $dates = ['deleted_at'];
	protected $fillable = ['id_transaksi','id_paket','qty','keterangan'];

	public function paket_dat(){
		return $this->hasOne('App\tb_paket','id','id_paket');
	}

	public function trans_dat(){
		return $this->hasOne('App\tb_transaksi','id','id_transaksi');
	}
}
