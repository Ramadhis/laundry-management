@extends('core')
@section('judul_halaman', 'Add diskon')
@section('konten')
  <form method="POST" name="add" action="{{route('diskon.store')}}">
    @csrf
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Nama</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">persen</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="per" placeholder="persen" required>
      </div>
    </div>
    
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Tanggal mulai</label>
      <div class="col-sm-10">
        <input type="date" class="form-control mb-2"" name="tgl_mulai" placeholder="Tanggal Mulai" required>
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Tanggal Berakhir</label>
      <div class="col-sm-10">
        <input type="date" class="form-control mb-2"" name="tgl_berakhir" placeholder="Tanggal Berakhir" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label form-label">Keterangan</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="ket" placeholder="Keterangan" required>
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