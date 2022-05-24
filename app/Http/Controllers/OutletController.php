<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tb_outlet;

class OutletController extends Controller
{
    public function outlet_add(Request $req){
    	$dat = Tb_outlet::create([
    		'nama' => $req->nama,
    		'alamat' => $req->ala,
    		'tlp' => $req->telp,
    	]);
    	return redirect('outlet/')->with('msg', 'Berhasil input data');
    }

    public function outlet_edit(Request $req){
    	$id = $req->id;
    	$ed = Tb_outlet::find($id);
    	$ed->nama = $req->nama;
    	$ed->alamat = $req->ala;
    	$ed->tlp = $req->telp;
    	$ed->save();
    	return redirect('outlet/')->with('msg', 'Berhasil edit data');
    }

    public function outlet_del($id){
    	$del = Tb_outlet::find($id);
    	$del->delete();
    	return redirect('outlet/')->with('msg', 'Berhasil hapus data');
    }

    public function show_edit($id){
    	$query = Tb_outlet::find($id);
    	return view('outlet.edit',['outlet' => $query]);
    }

    public function show_add(){
    	return view('outlet.add');
    }
}
