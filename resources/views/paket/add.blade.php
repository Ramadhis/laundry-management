@extends('core')
@section('judul_halaman', 'Add Member')
@section('konten')
  <form method="POST" name="add" action="{{route('paket.store')}}">
    @csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Outlet</label>
      <div class="col-sm-10">
        <select class="form-control" name="outlet" required>
          <option>--Pilih--</option>
          @foreach($outlet as $o)
          <option value="{{$o->id}}">{{$o->nama}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Jenis Paket</label>
      <div class="col-sm-10">
        <select class="form-control" name="jenis" required>
          <option>--Pilih--</option>
          <option value="kiloan">Kiloan</option>
          <option value="selimut">Selimut</option>
          <option value="selimut">Bed cover</option>
          <option value="kaos">kaos</option>
          <option value="lain">Lain</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama Paket</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Harga</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="harga" placeholder="Harga" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection