@extends('core')
@section('judul_halaman', 'Info Transaksi')
@section('konten')
<style type="text/css">
  .margin_add{
    margin-bottom: 30px;
  }
</style>

@if (session('msg'))
<div class="alert alert-Success alert-dismissible fade show" role="alert">
    {{session('msg')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div style="float: right;">
  @if($trans->dibayar == 'belum_dibayar')
  <a href="javascript:void(0)" class="btn btn-sm btn-info margin_add" data-toggle="modal" data-target="#bayar">Bayar Sekarang</a>
  <a href="javascript:void(0)" class="btn btn-sm btn-info margin_add" data-toggle="modal" data-target="#tab_biaya">Tambah/kurangi Biaya</a>
  <a href="javascript:void(0)" data-toggle="modal" data-target="#diskon" class="btn btn-sm btn-info margin_add">Pasang Diskon</a>
  @endif
  @if($trans->dibayar == 'dibayar')
  <a href="javascript:void(0)" class="btn btn-sm btn-success margin_add" >Pembayaran Selesai</a>
  <a href="" class="btn btn-sm btn-info margin_add">Print Struk</a>
  @endif
  
</div>

<table class="table">
  <tr>
    <td width="200" border="1">
      #ID
    </td>
    <td>
      {{$trans->id}}
    </td>
  </tr>
  <tr>
    <td>
      #ID Outlet
    </td>
    <td>
      {{$trans->id_outlet}}
    </td>
  </tr>
  <tr>
    <td>
      #ID Member
    </td>
    <td>
      {{$trans->id_member}}
    </td>
  </tr>
  <tr>
    <td>
      #ID user
    </td>
    <td>
      {{(isset($trans->id_user) ? $trans->id_user : '-')}}
    </td>
  </tr>
  <tr>
    <td>
      Kode Invoice
    </td>
    <td>
      {{$trans->kode_invoice}}
    </td>
  </tr>
  <tr>
    <td>
      Tanggal
    </td>
    <td>
      {{date('d F Y',strtotime($trans->tgl))}}
    </td>
  </tr>
  <tr>
    <td>
      Batas Waktu
    </td>
    <td>
      {{date('d F Y',strtotime($trans->batas_waktu))}}
    </td>
  </tr>
  <tr>
    <td>
      Tanggal Bayar
    </td>
    <td>
      {{date('d F Y',strtotime($trans->tgl_bayar))}}
    </td>
  </tr>
  <tr>
    <td>
      Biaya Tambahan
    </td>
    <td>
      {{(isset($trans->biaya_tambahan) ? $trans->biaya_tambahan : '0')}}
    </td>
  </tr>
  <tr>
    <td>
      Diskon
    </td>
    <td>
      {{(isset($trans->diskon) ? $trans->diskon : '0')}}
    </td>
  </tr>
  <tr>
    <td>
      Pajak
    </td>
    <td>
      {{(isset($trans->pajak) ? $trans->pajak : '0')}}
    </td>
  </tr>
  @if(isset($trans->nominal_bayar))
  <tr>
    <td>Nominal bayar</td>
    <td>
      {{(isset($trans->nominal_bayar) ? $trans->nominal_bayar : '0')}}
    </td>
  </tr>
  @endif
  <tr>
    <td>
      Status
    </td>
    <td>
      <form>
        @php($br='')
        @php($ps='')
        @php($se='')
        @php($di='')
        @if($trans->status == 'baru')
          @php($br = 'checked disabled')
        @elseif($trans->status == 'proses')
          @php($br = 'checked disabled')
          @php($ps = 'checked disabled')
        @elseif($trans->status == 'selesai')
          @php($br = 'checked disabled')
          @php($ps = 'checked disabled')
          @php($se = 'checked disabled')
        @elseif($trans->status == 'diambil')
          @php($br = 'checked disabled')
          @php($ps = 'checked disabled')
          @php($se = 'checked disabled')
          @php($di = 'checked disabled')
        @endif
        <label class="label" style="margin-right: 10px;">
          <input type="checkbox" class="checkbox" value="baru" name="br" {{$br}}>
          Baru
        </label>
        <label class="label" style="margin-right: 10px;">
          <input type="checkbox" class="checkbox" value="proses" name="ps" {{$ps}}>
          Proses
        </label>
        <label class="label" style="margin-right: 10px;">
          <input type="checkbox" class="checkbox" value="selesai" name="se" {{$se}}>
          Selesai
        </label>
        <label class="label">
          <input type="checkbox" class="checkbox" value="diambil" name="di" {{$di}}>
          Diambil
        </label>
      </form>
      #centang salah satu untuk mengubah status
    </td>
  </tr>
  <tr>
    <td>
      Keterangan
    </td>
    <td>
      {{(isset($det->keterangan) ? $det->keterangan : '-')}}
    </td>
  </tr>
</table>

<!-- Modal -->
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('transaksi.bayar')}}">
          @csrf
          <input type="hidden" name="id" value="{{$trans->id}}">
          <input type="hidden" name="det" value="{{$det->id}}">
          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label"> QTY (Kg/pcs): </label>
            <div class="col-md-8">
              <input class="form-control" type="number" name="qty" value="{{$det->qty}}" readonly>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label"> Harga Paket (Rp): </label>
            <div class="col-md-8">
              <input class="form-control" type="number" name="hrg" value="{{$det->paket_dat->harga}}" readonly>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label">total Diskon (Rp): </label>
            <div class="col-md-8">
              <input class="form-control" type="number" name="dkn" value="{{$trans->diskon}}" readonly>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label">Biaya Tambahan (Rp): </label>
            <div class="col-md-8">
              <input class="form-control" type="number" name="tam" value="{{$trans->biaya_tambahan}}" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label">Total (Rp): </label>
            <div class="col-md-8">
              <input class="form-control total" type="number" name="tam" value="20000" readonly>
            </div>
          </div>

          <table class="table">
            <tr>
              <td>
                
              </td>
            </tr>
          </table>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label">Dibayar (Rp): </label>
            <div class="col-md-8">
              <input class="form-control byar" type="number" name="tam" max="1000000" value="">
            </div>
          </div>
          <div class="kembalian_ket">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary simp" disabled>Bayar</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tab_biaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penambahan/Pengurangan Biaya</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('transaksi.tambiaya')}}">
          <fieldset class="form-group">
            @csrf
            <input type="hidden" name="id" value="{{$trans->id}}">
            <input type="hidden" name="det" value="{{$det->id}}">
            <div class="form-check col-md-12">
            <label class="form-label" >
              <input type="radio" name="rad" value="1" checked>
              Penambahan
            </label>
            </div>
            <div class="form-check col-md-12">
            <label class="form-label">
              <input type="radio" name="rad" value="2">
              Pengurangan
            </label>
            </div>
          </fieldset>
          <table class="table">
            <tr>
              <td>
              </td>
            </tr>
          </table>
          <div class="form-group row">
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label form-label"> Biaya (Rp): </label>
            <div class="col-md-8">
              <input class="form-control" type="number" name="biaya">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="diskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pasang Diskon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="col-md-12">
            <select class="form-control" name="diskon" id="dis">
                <option value="" selected>--Pilih--</option>
              @foreach($diskon as $d)  
                <option value="{{$d->id}}">{{$d->nama}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-12" style="margin-top: 10px;">
            <label class="form-label">Keterangan :</label>
            <div id="ket">Ini buat isi keterangan dibuat biar panjang aja buat test sepanjang apa text yang bisa di tampung</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
  <script>
    $(".checkbox").change(function() {
      if(this.checked) {
        var va = $(this).val();

        $.ajax({
          url:"{{route('transaksi.upstatus')}}",
          data: {"_token": "{{ csrf_token() }}",'check' : va,'id' : "{{$trans->id}}"},
          type : 'POST',
          dataType: 'json',
          cache :false,
          success: function(data){
            location.reload();
          }
        })

      }
    });

    $(".total").ready(function() {
      var qty = parseInt('{{$det->qty}}');
      var hrg = parseInt('{{$det->paket_dat->harga}}');
      var diskon = parseInt('{{$trans->diskon}}');
      var bi_tmb = parseInt('{{($trans->biaya_tambahan ? $trans->biaya_tambahan : "0")}}');
      var total = ((qty * hrg)-diskon)+bi_tmb;

      $('.total').val(total);

    });

    $("#dis").change(function(){
      var dat = $("#dis").val();
    })

    $(".byar").keyup(function() {
      var dibutuhkan = parseInt($('.total').val());
      var bayar = parseInt($('.byar').val());

      if (dibutuhkan > bayar ) {
        var kurang = dibutuhkan-bayar;
        $('.kembalian_ket').html('Biaya '+kurang);
        $('.simp').prop('disabled',true);
      }else if(dibutuhkan < bayar){
        var lebih = bayar - dibutuhkan; 
        $('.kembalian_ket').html('Biaya Kelebihan '+lebih);
        $('.simp').prop('disabled',false);
      }else if(dibutuhkan == bayar){
        $('.kembalian_ket').html('Biaya cukup');
        $('.simp').prop('disabled',false);
      }else{
        $('.kembalian_ket').html('');
        $('.simp').prop('disabled',true);
      }
    });
  </script>
@endsection