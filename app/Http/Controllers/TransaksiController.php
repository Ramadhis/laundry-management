<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_transaksi;
use App\tb_detail_trasaksi;
use App\tb_member;
use App\tb_paket;
use App\tb_diskon;
use App\Helpers\UserHelper;

class TransaksiController extends Controller
{
    public function transaksi_add(Request $req){
    	$help = new UserHelper;

        
    	$tgl_inv = date('dmy');
    	//echo $tgl_inv;
    	//buat invoice
    	$last_data = tb_transaksi::orderBy('id','DESC')->limit(1)->first();
    	if (isset($last_data)) {
    		$last_code = substr($last_data->kode_invoice, 12);
    	}

    	if ((int)$last_code == 0) {
            $code = 1;
        }else{
            $code = (int)$last_code + 1;
        }
        
    	
        $count_string = strlen($last_code);
    	
    	$code = sprintf('%04s',$code);
    	$outlet_num = sprintf('%02s',$help->outletID());

    	$kode_inv = 'TRA'.$outlet_num.$tgl_inv.$code;
        // end buat invoice
    	
        
    	$tgl =  date('Y-m-d H:i:s');
    	$batas = date('Y-m-d H:i:s', strtotime('+6 days', strtotime($tgl)));

        //hitung biaya

        $paket_q = tb_paket::find($req->paket);
        $hit_hrg = (int)$paket_q->harga * (int)$req->qty;
        $pajak = $hit_hrg * 10/100;
        //echo $hit_hrg.'  '.$pajak;

        //end biaya

        
    	$dat = tb_transaksi::create([
    		'id_outlet'=> $help->outletID(),
			'kode_invoice'=> $kode_inv,
			'id_member'=> $req->member,
			'tgl'=> $tgl,
			'batas_waktu'=> $batas,
			'tgl_bayar'=> $tgl,
			'biaya tambahan'=> '0',
			'diskon'=> '0',
			'pajak'=> $pajak,
			'status'=> 'baru',
			'dibayar'=> 'belum_dibayar',
			'id_user'=> $help->userID(),
    	]);

    	$dat2 = tb_detail_trasaksi::create([
    		'id_transaksi' => $dat->id,
    		'id_paket' => $req->paket,
    		'qty' => $req->qty,
    		'keterangan' => $req->ket,
    	]);
    	return redirect('transaksi/')->with('msg', 'Berhasil input data');
        
    }

    public function transaksi_edit(Request $req){
    	$id = $req->id;
    	$ed = tb_detail_trasaksi::find($id);
    	$ed->id_paket = $req->paket;
    	$ed->qty = $req->qty;
    	$ed->keterangan = $req->ket;

        //hitung biaya

        $paket_q = tb_paket::find($req->paket);
        $hit_hrg = (int)$paket_q->harga * (int)$req->qty;
        $pajak = $hit_hrg * 10/100;
        //echo $hit_hrg.'  '.$pajak;

        //end biaya

        $tr = tb_transaksi::find($ed->id_transaksi);
        $tr->id_member = $req->member;
        $tr->pajak = $pajak;

        $tr->save();
    	$ed->save();
    	return redirect('transaksi/')->with('msg', 'Berhasil edit data');
    }

    public function transaksi_del($id){
    	$del = tb_detail_trasaksi::find($id);
    	$del2 = tb_transaksi::find($del->id_transaksi);
    	$del->delete();
    	$del2->delete();
    	return redirect('transaksi/')->with('msg', 'Berhasil hapus data');
    }

    public function show_edit($id){
    	$query = tb_detail_trasaksi::find($id);
    	$help = new UserHelper;
    	$paket = tb_paket::Where(['id_outlet'=> $help->outletID()])->get();
    	$trans = tb_transaksi::find($query->id_transaksi);

    	return view('transaksi.edit',['det' => $query,'paket' => $paket ,'trans' => $trans]);
    }

    public function show_add(){
    	$help = new UserHelper;
    	$paket = tb_paket::Where(['id_outlet'=> $help->outletID()])->get();
    	return view('transaksi.add',['paket'=>$paket]);
    }

    public function show($id){
    	$detail = tb_detail_trasaksi::find($id);
    	$transaksi = tb_transaksi::find($detail->id_transaksi);
        $diskon = tb_diskon::Where('tb_diskon.tanggal_berakhir','>=',date('Y-m-d'))->Where('tb_diskon.tanggal_mulai','<=',date('Y-m-d'))->get();
        return view('transaksi.show',['det' => $detail, 'trans' => $transaksi,'diskon' => $diskon]);
    }

    public function cek(Request $req){
    	$id = $req->id;
    	$member = tb_member::Where('id',$id)->get();
    	$co_member = count($member);
    	if ($co_member == 1) {
    		return '1';
    	}else{
    		return '0';
    	}
    }

    public function upstatus(Request $req){
        $up = tb_transaksi::find($req->id);
        $up->status = $req->check;
        $up->save();
        return '1';
    }

    public function bayar(Request $req){
        $up = tb_transaksi::find($req->id);
        $up->dibayar = 'dibayar';
        $up->nominal_bayar = $req->tam;
        $up->save();
        return redirect('transaksi/show/'.$req->det)->with('msg', 'Pembayaran Berhasil, Silahkan Print Struk pembayaran');
    }

    public function tambiaya(Request $req){
        $up = tb_transaksi::find($req->id);

        if ($req->rad == '1') {
            $up->biaya_tambahan = (int)$up->biaya_tambahan + (int)$req->biaya;
        }else if($req->rad == '2'){
            $up->biaya_tambahan = (int)$up->biaya_tambahan - (int)$req->biaya;
        }
        $up->save();
        return redirect('transaksi/show/'.$req->det)->with('msg', 'Berhasil Menambahkan biaya');
    }
}
