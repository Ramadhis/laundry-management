<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_paket;
use App\Tb_outlet;

class PaketController extends Controller
{
    public function paket_add(Request $req){
    	$dat = tb_paket::create([
    		'id_outlet' =>$req->outlet,
    		'jenis' => $req->jenis,
    		'nama_paket' => $req->nama,
    		'harga' => $req->harga,
    	]);
    	return redirect('paket/')->with('msg', 'Berhasil input data');
    }

    public function paket_edit(Request $req){
    	$id = $req->id;
    	$ed = tb_paket::find($id);
    	$ed->id_outlet = $req->outlet;
    	$ed->jenis = $req->jenis;
    	$ed->nama_paket = $req->nama;
    	$ed->harga = $req->harga;
    	$ed->save();
    	return redirect('paket/')->with('msg', 'Berhasil edit data');
    }

    public function paket_del($id){
    	$del = tb_paket::find($id);
    	$del->delete();
    	return redirect('paket/')->with('msg', 'Berhasil hapus data');
    }

    public function show_edit($id){
    	$outlet = Tb_outlet::All();
    	$query = tb_paket::find($id);
    	return view('paket.edit',['paket' => $query, 'outlet' => $outlet]);
    }

    public function show_add(){
    	$outlet = Tb_outlet::All();
    	return view('paket.add',['outlet'=> $outlet]);
    }
}
