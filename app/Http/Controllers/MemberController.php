<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_member;

class MemberController extends Controller
{
    public function member_add(Request $req){
    	$dat = tb_member::create([
    		'nama' => $req->nama,
    		'alamat' => $req->ala,
    		'jenis_kelamin' => $req->jk,
    		'tlp' => $req->telp,
    	]);
    	return redirect('member/')->with('msg', 'Berhasil input data');
    }

    public function member_edit(Request $req){
    	$id = $req->id;
    	$ed = tb_member::find($id);
    	$ed->nama = $req->nama;
    	$ed->alamat = $req->ala;
    	$ed->jenis_kelamin = $req->jk;
    	$ed->tlp = $req->telp;
    	$ed->save();
    	return redirect('member/')->with('msg', 'Berhasil edit data');
    }

    public function member_del($id){
    	$del = tb_member::find($id);
    	$del->delete();
    	return redirect('member/')->with('msg', 'Berhasil hapus data');
    }

    public function show_edit($id){
    	$query = tb_member::find($id);
    	return view('member.edit',['member' => $query]);
    }

    public function show_add(){
    	return view('member.add');
    }
}
