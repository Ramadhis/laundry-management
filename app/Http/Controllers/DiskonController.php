<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_diskon;

class DiskonController extends Controller
{
    public function diskon_add(Request $req){
    	//echo $req->tgl_berakhir;

    	$dat = tb_diskon::create([
    		'nama' => $req->nama,
    		'persen' => $req->per,
    		'tanggal_mulai' => $req->tgl_mulai,
    		'tanggal_berakhir' => $req->tgl_berakhir,
    		'keterangan' => $req->ket,
    		
    	]);
    	return redirect('diskon/')->with('msg', 'Berhasil input data');
    }

    public function diskon_edit(Request $req){
    	$id = $req->id;
    	$ed = tb_diskon::find($id);
    	$ed->nama = $req->nama;
    	$ed->persen = $req->per;
    	$ed->tanggal_mulai = $req->tgl_mulai;
    	$ed->tanggal_berakhir = $req->tgl_berakhir;
    	$ed->keterangan = $req->ket;

    	$ed->save();
    	return redirect('diskon/')->with('msg', 'Berhasil edit data');
    }

    public function diskon_del($id){
    	$del = tb_diskon::find($id);
    	$del->delete();
    	return redirect('diskon/')->with('msg', 'Berhasil hapus data');
    }

    public function show_edit($id){
    	$query = tb_diskon::find($id);
    	return view('diskon.edit',['diskon' => $query]);
    }

    public function show_add(){
    	return view('diskon.add');
    }
}
