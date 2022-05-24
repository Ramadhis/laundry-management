@extends('core')
@section('judul_halaman', 'Add Member')
@section('konten')
  <form method="POST" name="add" action="{{route('user.store')}}">
    @csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="em" placeholder="Alamat" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="pas" placeholder="Alamat" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Outlet</label>
      <div class="col-sm-10">
      <select class="form-control" name="outlet" required>
        <option value="">--Pilih--</option>
        @foreach($outlet as $a)
          <option value="{{$a->id}}">{{$a->nama}}</option>
        @endforeach
      </select>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Role</label>
      <div class="col-sm-10">
      <select class="form-control" name="role" required>
        <option value="">--Pilih--</option>
        <option value="admin">Admin</option>
        <option value="kasir">Kasir</option>
        <option value="owner">Owner</option>
      </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
@endsection