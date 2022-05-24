<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Tb_outlet;
use App\tb_detail_trasaksi;
use App\tb_member;
use App\tb_paket;
use App\tb_diskon;
use App\tb_transaksi;
use App\Helpers\UserHelper;

class AndroidcoreController extends Controller
{	
	public $successStatus = 200;

    public function get_all_outlet(){
        $outlet = Tb_outlet::all();
        return response()->json(['outlet'=>$outlet], $this->successStatus);
    }

    public function get_all_diskon(){
        $diskon = tb_diskon::all();
        return response()->json(['diskon'=>$diskon], $this->successStatus);
    }

    public function get_all_member(){
        $member = tb_member::all();
        return response()->json(['member'=>$member], $this->successStatus);
    }

	public function get_all_paket(){
        $role = new UserHelper;
      	//$paket = tb_paket::Where(['id_outlet' => $role->outletID()])->get();
        $paket = tb_paket::all();
        return response()->json(['paket'=>$paket], $this->successStatus);
    }

    public function get_all_trans(){
        $trans = tb_detail_trasaksi::join('tb_transaksi','tb_detail_transaksi.id_transaksi','=','tb_transaksi.id')->get();
        return response()->json(['trans'=>$trans], $this->successStatus);
    }

    protected function get_all_user(){
        $user = User::Where('role','!=','admin')->get();
        return response()->json(['user'=>$user], $this->successStatus);
    }

    public function outlet_add(Request $req){
        $dat = Tb_outlet::create([
            'nama' => $req->nama,
            'alamat' => $req->ala,
            'tlp' => $req->telp,
        ]);
        return response()->json(['success'=>'berhasil'], $this->successStatus);
    }



}
