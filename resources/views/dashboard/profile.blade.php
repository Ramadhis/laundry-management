<!-- Menghubungkan dengan view template master -->
@extends('core')
 
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Profile')

@section('konten')
 	<div class="row">
    <div class="col-md-4 col-sm-4">
      <div class="col-md-12">
        <center>
          <div class="col-md-12">
            <img class="d-inline-block align-top" style="width: 50%;" src="{{url((isset($user->image_profile) ? 'img/profile/'.$user->image_profile : 'img/logo.png' ))}}">
          </div>
          <div class="col-md-12">
            <a href="javascript:void(0)" class="btn btn-primary" style="margin-top: 10px;margin-bottom: 20px;" data-toggle="modal" data-target="#up">Pilih Foto Profile</a>
          </div>
              
        </center>
      </div>
    </div>
    <div class="col-md-8 col-sm-8">
    <div class="col-md-12">
        <h2>{{$user->name}}</h2>
    </div>
    <div class="col-md-12">
      <a href="javascript:void(0)" style="">{{$user->email}}</a>
      <a>-</a>
      <a>{{$user->role}}</a>
    </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('user.upload')}}" enctype="multipart/form-data">
          <fieldset class="form-group">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">

            <input type="file" name="img" required>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection