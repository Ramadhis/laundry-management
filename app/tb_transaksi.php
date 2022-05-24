<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_transaksi extends Model
{
	use SoftDeletes;
	protected $table = 'tb_transaksi';
	protected $dates = ['deleted_at'];
	protected $fillable = ['id_outlet','kode_invoice','id_member','tgl','batas_waktu','tgl_bayar','biaya_tambahan','diskon','pajak','status','dibayar','nominal_bayar','id_user'];
}
