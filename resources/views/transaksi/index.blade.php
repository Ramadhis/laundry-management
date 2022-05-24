<!-- Menghubungkan dengan view template master -->
@extends('core')
 
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Management transaksi')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
 	<a href="{{route('transaksi.add')}}" class="btn btn-success" style="margin-bottom: 20px;">Add Transaksi</a>
	
	@if (session('msg'))
 	<div class="alert alert-Success alert-dismissible fade show" role="alert">
  		{{session('msg')}}
  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
	</div>
	@endif
	
	<table class="table table-bordered mb-0" id="outlet-table">
	  <thead>
	    <tr>
	      <th scope="col">No</th>
	      <th scope="col">#Id_Transaksi</th>
				<th scope="col">#Id_Member</th>
	      <th scope="col">Paket</th>
	      <th scope="col">Qty</th>
	      <th scope="col">Status Pengerjaan</th>
				<th scope="col">Status pembayaran</th>
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
	<a href="coba" onclick="delaja()" id="dela">AAAA</a>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

	<script>
$(document).ready(function() {
    $('#outlet-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'transaksi/json_out',
        columns: [
            { data: 'DT_RowIndex', name: 'no' },
            { data: 'id_transaksi', name: 'id_transaksi' },
						{ data: 'id_member', name: 'id_member' },
            { data: 'paket', name: 'paket' },
            { data: 'qty', name: 'qty' },
            { data: 'stat', name: 'stat' },
						{ data: 'dibayar', name: 'dibayar' },
            { data: 'aksi', name: 'aksi' },
        ]
    });
});
	</script>
@endsection

@section('scripts')

@endsection