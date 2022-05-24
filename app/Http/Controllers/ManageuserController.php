<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Tb_outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ManageuserController extends Controller
{
	public function user_add(Request $req){
    	$token = Str::random(60);
        User::create([
            'name' => $req->nama,
            'email' => $req->em,
            'password' => Hash::make($req->pas),
            'id_outlet' => $req->outlet,
            'api_token' => hash('sha256', $token),
            'role' => $req->role,
        ]);
    	return redirect('user/')->with('msg', 'Berhasil input data');
    }

    public function user_edit(Request $req){
    	$id = $req->id;
    	$ed = User::find($id);
    	
    	$ed->name = $req->nama;
        $ed->email = $req->em;
        $ed->id_outlet = $req->outlet;
        $ed->role = $req->role;
    	$ed->save();
    	return redirect('user/')->with('msg', 'Berhasil edit data');
    }

    public function user_del($id){
    	$del = User::find($id);
    	$del->status = '0';
    	$del->save();
    	return redirect('user/')->with('msg', 'Berhasil Mengubah status');
    }

    public function user_on($id){
    	$del = User::find($id);
    	$del->status = '1';
    	$del->save();
    	return redirect('user/')->with('msg', 'Berhasil Mengubah status');
    }

    public function show_edit($id){
    	$query = User::find($id);
    	$outlet = Tb_outlet::All();
    	return view('managuser.edit',['user' => $query,'outlet' => $outlet]);
    }

    public function show_add(){
    	$outlet = Tb_outlet::All();
    	return view('managuser.add',['outlet' => $outlet]);
    }

    public function upload(Request $req){
        $id = $req->id;
        $file = $req->file('img');
        //dd($file);
        $user = User::find($id);

        $image_path = "img/profile/".(isset($user->image_profile) ? $user->image_profile : '');
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $name_original = "ID".$id.$file->getClientOriginalName();
        
        $tujuan_upload = 'img/profile/';
        $file->move($tujuan_upload,$name_original);

        
        $user->image_profile = $name_original;
        $user->save();

        return redirect('home/profile')->with('msg', 'Berhasil upload image');
    }
}
