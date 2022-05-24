@extends('core')
@section('judul_halaman', 'Add Transaksi')
@section('konten')
  <form method="POST" name="add" action="{{route('transaksi.storeEd')}}">
    @csrf
    <input type="hidden" name="id" value="{{$det->id}}">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Id Member</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="memberid" name="member" value="{{$trans->id_member}}" placeholder="member" required>
      </div>
      <div class="col-sm-6" id="output" style="display: none;">Id Member tersedia</div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Pilih Paket</label>
      <div class="col-sm-10">
        <select class="form-control" name="paket" required>
          <option value="">--Pilih--</option>
          @foreach($paket as $p)
              <option value="{{$p->id}}" {{($det->id_paket == $p->id ? 'selected' : '')}}>{{$p->nama_paket}}</option>    
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Qty</label>
      <div class="col-sm-10">
        <input type="number" min="1" max="10" class="form-control" value="{{$det->qty}}" name="qty" placeholder="Qty" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Keterangan</label>
      <div class="col-sm-10">
        <textarea type="number" class="form-control" name="ket" placeholder="Keterangan" required>{{ $det->keterangan }}
          </textarea>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" id="falid" type="submit" class="btn btn-primary" disabled>Submit</button>
      </div>
    </div>
  </form>
@endsection

@section('scripts')
  <script>
  $(document).ready(function(){
    $('#memberid').keyup(function (){
      var id_member = $('#memberid').val();

      $.ajax({
        url:"{{route('transaksi.cekid')}}",
        data: {"_token": "{{ csrf_token() }}",'id' : id_member},
        type : 'POST',
        dataType: 'json',
        cache :false,
        success: function(dat){
          if (dat == '1') {
            $('#output').css('display','block');
            $('#output').css('color','green');
            $('#output').html('Id Member tersedia');
            $('#falid').prop('disabled',false);

          }else{
            $('#output').css('display','block');
            $('#output').css('color','red');
            $('#output').html('Id Member tidak tersedia');
            $('#falid').prop('disabled',true);

          }
        }
      })
    })
  })
  $(document).ready(function(){
    $('#memberid').ready(function (){
      var id_member = $('#memberid').val();

      $.ajax({
        url:"{{route('transaksi.cekid')}}",
        data: {"_token": "{{ csrf_token() }}",'id' : id_member},
        type : 'POST',
        dataType: 'json',
        cache :false,
        success: function(dat){
          if (dat == '1') {
            $('#output').css('display','block');
            $('#output').css('color','green');
            $('#output').html('Id Member tersedia');
            $('#falid').prop('disabled',false);

          }else{
            $('#output').css('display','block');
            $('#output').css('color','red');
            $('#output').html('Id Member tidak tersedia');
            $('#falid').prop('disabled',true);

          }
        }
      })
    })
  })
  </script>
@endsection