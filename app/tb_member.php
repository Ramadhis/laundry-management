<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_member extends Model
{
	use SoftDeletes;
	protected $table = 'tb_member';

	protected $fillable = ['nama','alamat','jenis_kelamin','tlp'];
    //
}
