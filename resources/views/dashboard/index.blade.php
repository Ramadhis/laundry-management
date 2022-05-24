<!-- Menghubungkan dengan view template master -->
@extends('core')
 
<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul_halaman', 'Dashboard')
 
 
<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('head_dashborad')
 <div class="row">
   <div class="col-md-6 col-lg-3 d-flex">
     <div class="card mb-grid w-100">
       <div class="card-body d-flex flex-column">
         <div class="d-flex justify-content-between mb-3">
           <h5 class="card-title mb-0">
             Transaksi Baru
           </h5>
           <div class="card-title-sub">
             {{$bar}}
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-6 col-lg-3 d-flex">
     <div class="card mb-grid w-100">
       <div class="card-body d-flex flex-column">
         <div class="d-flex justify-content-between mb-3">
           <h5 class="card-title mb-0">
             Transaksi Selesai
           </h5>
           <div class="card-title-sub">
             {{$sel}}
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-6 col-lg-3 d-flex">
     <div class="card border-0 bg-primary text-white text-center mb-grid w-100">
       <div class="d-flex flex-row align-items-center h-100">
         <div class="card-icon d-flex align-items-center h-100 justify-content-center">
           <i data-feather="shopping-cart"></i>
         </div>
         <div class="card-body">
           <div class="card-info-title">Total Transaksi</div>
           <h3 class="card-title mb-0">
             {{$all}}
           </h3>
         </div>
       </div>
     </div>
   </div>
   <div class="col-md-6 col-lg-3 d-flex">
     <div class="card border-0 bg-success text-white text-center mb-grid w-100">
       <div class="d-flex flex-row align-items-center h-100">
         <div class="card-icon d-flex align-items-center h-100 justify-content-center">
           <i data-feather="users"></i>
         </div>
         <div class="card-body">
           <div class="card-info-title">member</div>
           <h3 class="card-title mb-0">
             {{$member}}
           </h3>
         </div>
       </div>
     </div>
   </div>
 </div>
 @endsection


@section('konten')
  <div class="col-md-12">
      <canvas id="myChart"></canvas>
  </div>
@endsection

@section('scripts')
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [@foreach($buln as $a ){!! '"'.$a.'",' !!} @endforeach],
            datasets: [{
                label: 'Total transaksi perbulan',
                backgroundColor: 'rgb(12, 106, 248)',
                borderColor: 'rgb(12, 52, 248)',
                data: [@foreach($dat_trans as $a ){{ $a.($a[6] ? "" : ",") }} @endforeach]/*[10, 10, 5, 2, 20, 30, 45]*/
            }]
        },
        // Configuration options go here
        options: {

          
        }
    });
    </script>
@endsection