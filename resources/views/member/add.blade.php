@extends('core')
@section('judul_halaman', 'Add Member')
@section('konten')
  <form method="POST" name="add" action="{{route('member.store')}}">
    @csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Alamat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="ala" placeholder="Alamat" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Jenis Kelamin</label>
      <div class="col-sm-10">
        <select class="form-control" name="jk" required>
          <option>--Pilih--</option>
          <option value="L">Laki-Laki</option>
          <option value="P">Perempuan</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">No telepon</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="telp" placeholder="no telepon" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection