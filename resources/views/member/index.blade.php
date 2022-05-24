<!-- Menghubungkan dengan view template master -->
@extends('core')
 
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Management member')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
 	<a href="{{route('member.add')}}" class="btn btn-success" style="margin-bottom: 20px;">Add member</a>
	<table class="table table-bordered mb-0" id="member-table">
	  <thead>
	    <tr>
	      <th scope="col">Id</th>
	      <th scope="col">Nama</th>
	      <th scope="col">Alamat</th>
	      <th scope="col">Jenis kelamin</th>
	      <th scope="col">Telepon</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	    <!--
	    <tr>
	      <th scope="row">1</th>
	      <td>Mark</td>
	      <td>Otto</td>
	      <td>
	      	<a href="" class="btn btn-sm btn-primary">Edit</a>
	      	<a href="" class="btn btn-sm btn-danger">Delete</a>
	      </td>
	    </tr>
	    <tr>
	      <th scope="row">2</th>
	      <td>Jacob</td>
	      <td>Thornton</td>
	      <td><a href="" class="btn btn-sm btn-primary">Edit</a>
	      	<a href="" class="btn btn-sm btn-danger">Delete</a></td>
	    </tr>
	    <tr>
	      <th scope="row">3</th>
	      <td>Larry</td>
	      <td>the Bird</td>
	      <td><a href="" class="btn btn-sm btn-primary">Edit</a>
	      	<a href="" class="btn btn-sm btn-danger">Delete</a></td>
	    </tr>
		-->
	  </tbody>
	</table>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script>
$(document).ready(function() {
    $('#member-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'member/json_out',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama', name: 'nama' },
            { data: 'alamat', name: 'alamat' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'tlp', name: 'tlp' },
            { data: 'aksi', name: 'aksi' },
        ]
    });
});
	</script>
 
@endsection