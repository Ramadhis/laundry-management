@extends('core')
@section('judul_halaman', 'Add Member')
@section('konten')
  <form method="POST" name="add" action="{{route('paket.storeEd')}}">
    @csrf
    <input type="hidden" name="id" value="{{$paket->id}}">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Outlet</label>
      <div class="col-sm-10">
        <select class="form-control" name="outlet" required>
          <option>--Pilih--</option>
          @foreach($outlet as $o)
          <option value="{{$o->id}}" {{($o->id == $paket->id_outlet ? 'selected' : '')}}>{{$o->nama}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Jenis Paket</label>
      <div class="col-sm-10">
        <select class="form-control" name="jenis" required>
          <option>--Pilih--</option>
          <option value="kiloan" {{($paket->jenis == 'kiloan' ? 'selected' : '')}}>Kiloan</option>
          <option value="selimut" {{($paket->jenis == 'selimut' ? 'selected' : '')}}>Selimut</option>
          <option value="bed_cover" {{($paket->jenis == 'bed_cover' ? 'selected' : '')}}>Bed cover</option>
          <option value="kaos" {{($paket->jenis == 'kaos' ? 'selected' : '')}}>kaos</option>
          <option value="lain" {{($paket->jenis == 'lain' ? 'selected' : '')}}>Lain</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama Paket</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" value="{{$paket->nama_paket}}" placeholder="Nama" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Harga</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="harga" value="{{$paket->harga}}" placeholder="Harga" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection