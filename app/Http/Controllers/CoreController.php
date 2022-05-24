<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_detail_trasaksi;
use App\Tb_outlet;
use App\tb_member;
use App\tb_paket;
use App\tb_diskon;
use App\tb_transaksi;
use App\User;
use App\Helpers\UserHelper;
use DataTables;
use db;

class CoreController extends Controller
{
    public function index(){
        $role = new UserHelper;
        $bar = tb_transaksi::Where('status','baru')->get();
        $sel = tb_transaksi::Where('status','selesai')->get();
        $all = tb_transaksi::All();
        $member = tb_member::All();
        /* contoh
        if($role->ifAdmin()){
            echo "string";
        }
        echo "<br>".$role->outletID();
        $cob = Tb_outlet::Where(['id' => 1])->get();

        foreach ($cob as $d) {
            echo $d->nama;
        }
        */

        $trans_per_tgl = array();
        $bln = array();
        //$trans = tb_transaksi::whereMonth('tgl','01')->get();

        //echo count($trans);
        $month = date('Y-m-d');
        $arr_bln = array('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sept','Okt','Nov','Des');
        //$batas = date('Y-m-d', strtotime('+1 month', strtotime($tgl)));
        $conv = date('m',strtotime($month));
        for ($i=0; $i <= 5 ; $i++) {
            if ($i == 0) {
                $trans = tb_transaksi::whereMonth('tgl',$conv)->get();
            }else{
                $month = date('Y-m-d', strtotime('-1 month', strtotime($month)));
                $conv = date('m',strtotime($month));
                $trans = tb_transaksi::whereMonth('tgl',$conv)->get();
            }
            $trans_per_tgl[$i] = (isset($trans) ? count($trans) : 0);
            //echo $trans.',';
            $bln[$i] = $arr_bln[(int)$conv];
            //$bln[$i] =$conv;

        }
//dd($bln);
        /*
        for ($i=0; $i < 12; $i++) { 
            $no = $i+1;
            $trans = tb_transaksi::whereMonth('tgl','0'.$no)->get();

            $trans_per_tgl[$i][1] = $no;
            $trans_per_tgl[$i][2] = (isset($trans) ? count($trans) : 0);
            $no = 0;
        }
        */
        //$trans_per_tgl = array(0,21,22,34,31,21);

        //dd($trans_per_tgl);
        
        
        return view('dashboard.index',[
            'bar' => count($bar),
            'sel' => count($sel),
            'all' => count($all),
            'member' => count($member),
            'dat_trans' => $trans_per_tgl,
            'buln' => $bln,
        ]);
        
    }

    public function pro(){
        $role = new UserHelper;
        $id = $role->userID();
        
        $user = User::find($id);
        return view('dashboard.profile',['user' => $user]);
    }

    public function trans_dashboard(){
    	return view('transaksi.index');
    }

    public function outlet_dashboard(){
    	return view('outlet.index');
    }

     public function diskon_dashboard(){
        return view('diskon.index');
    }

    private function get_all_outlet(){
    	$outlet = Tb_outlet::all();
    	return $outlet;
    }

    private function get_all_diskon(){
        $diskon = tb_diskon::all();
        return $diskon;
    }

    private function get_all_member(){
        $member = tb_member::all();
        return $member;
    }

    private function get_all_paket(){
        $role = new UserHelper;

        //$paket = tb_paket::Where(['id_outlet' => $role->outletID()])->get();
        $paket = tb_paket::all();
        return $paket;
    }

    private function get_all_user(){
        $user = User::Where('role','!=','admin')->get();
        return $user;
    }

    private function get_all_trans(){
        //$trans = tb_detail_trasaksi::all();
        $trans = tb_detail_trasaksi::join('tb_transaksi','tb_detail_transaksi.id_transaksi','=','tb_transaksi.id')->select(['tb_detail_transaksi.*','tb_transaksi.dibayar','tb_transaksi.id_member'])->get();
        return $trans;
    }

    public function outlet_json(){

    	$req = $this->get_all_outlet();
    	return Datatables::of($req)
    	->addIndexColumn()
    	->addColumn('aksi',function($req){
    		$id_outlet = '<a href="'.route('outlet.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
	      	
	      	$id_outlet .= '<a href="'.route('outlet.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Delete</a>';
	      	
    		return $id_outlet;
    	})
    	->rawColumns(['aksi'])
    	->make(true);
    }

    public function diskon_json(){

        $req = $this->get_all_diskon();
        return Datatables::of($req)
        ->addIndexColumn()
        ->addColumn('tgm',function($req){
            $tgl_mulai = date('d-m-Y',strtotime($req->tanggal_mulai));
            return $tgl_mulai;
        })
        ->addColumn('tgb',function($req){
          $tgl_berakhir = date('d-m-Y',strtotime($req->tanggal_berakhir));
          return $tgl_berakhir;  
        })->addColumn('aksi',function($req){
            $id_diskon = '<a href="'.route('diskon.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
            
            $id_diskon .= '<a href="'.route('diskon.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Delete</a>';
            
            return $id_diskon;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function member_json(){

        $req = $this->get_all_member();
        return Datatables::of($req)
        ->addIndexColumn()
        ->addColumn('aksi',function($req){
            $id_member = '<a href="'.route('member.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
            
            $id_member .= '<a href="'.route('member.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Delete</a>';
            
            return $id_member;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function paket_json(){

        $req = $this->get_all_paket();
        return Datatables::of($req)
        ->addIndexColumn()
        ->addColumn('outlet',function($req){
            //$role = new UserHelper;
            $id_out = Tb_outlet::Where(['id' => $req->id_outlet])->first();
            $nama = $id_out->nama;
            return $nama;
        })->addColumn('aksi',function($req){
            $id_paket = '<a href="'.route('paket.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
            
            $id_paket .= '<a href="'.route('paket.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Delete</a>';
            
            return $id_paket;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function user_json(){

        $req = $this->get_all_user();
        return Datatables::of($req)
        ->addIndexColumn()
        ->addColumn('outlet',function($req){
            //$role = new UserHelper;
            $id_out = Tb_outlet::Where(['id' => $req->id_outlet])->first();
            $nama = $id_out->nama;
            return $nama;
        })->addColumn('aksi',function($req){
            $id_user = '<a href="'.route('user.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
            
            if ($req->status == 0) {
                $id_user .= '<a href="'.route('user.aktifus',['id' => $req->id]).'" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')" class="btn btn-sm btn-info">On Status</a>';
                
            }else{
                $id_user .= '<a href="'.route('user.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Off Status</a>';
                
            }
            
            return $id_user;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function trans_json(){

        $req = $this->get_all_trans();
        return Datatables::of($req)
        ->addIndexColumn()
        ->addColumn('paket',function($req){
            //$role = new UserHelper;
            $id_pak = tb_paket::Where(['id' => $req->id_paket])->first();
            $nama = $id_pak->nama_paket;
            return $nama;
        })->addColumn('stat',function($req){
            $stat = $req->trans_dat->status;
            return $stat;
        })->addColumn('aksi',function($req){

            $id_trans = '<a href="'.route('transaksi.show',['id' => $req->id]).'" class="btn btn-sm btn-info" style="margin:2px;">Show</a>';
            
            $id_trans .= '<a href="'.route('transaksi.edit',['id' => $req->id]).'" class="btn btn-sm btn-primary" style="margin:2px;">Edit</a>';
            
            $id_trans .= '<a href="'.route('transaksi.delete',['id' => $req->id]).'" class="btn btn-sm btn-danger" id="dela-'.$req->id.'" onclick="delaja('.$req->id.')">Delete</a>';
            
            return $id_trans;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function member_dashboard(){
    	return view('member.index');
    }

    public function paket_dashboard(){
    	return view('paket.index');
    }

    public function manageuser_dashboard(){
    	return view('managuser.index');
    }
}
