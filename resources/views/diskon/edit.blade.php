@extends('core')
@section('judul_halaman', 'edit diskon')
@section('konten')
  <form method="POST" name="edit" action="{{route('diskon.storeEd')}}">
    @csrf
    <input type="hidden" name="id" value="{{$diskon->id}}">
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" value="{{$diskon->nama}}" placeholder="Nama" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">persen</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="per" value="{{$diskon->persen}}" placeholder="persen" required>
      </div>
    </div>
    
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Tanggal mulai</label>
      <div class="col-sm-10">
        <input type="date" class="form-control mb-2"" name="tgl_mulai" value="{{$diskon->tanggal_mulai}}" placeholder="Tanggal Mulai" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Tanggal Berakhir</label>
      <div class="col-sm-10">
        <input type="date" class="form-control mb-2"" name="tgl_berakhir" value="{{$diskon->tanggal_berakhir}}" placeholder="Tanggal Berakhir" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Keterangan</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="ket" placeholder="Keterangan" required>{{$diskon->keterangan}}
        </textarea>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-12">
        <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>

@endsection