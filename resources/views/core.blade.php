@php($help = new \App\Helpers\UserHelper )

<html>
<head>
	<title>Laundry Management</title>
</head>

 
	<header>
 	
  <link href="{{url('css/adminx.css')}}" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	</header>

	<body>
	<!-- A -->

	<div class="adminx-container">
      <!-- Header -->
      <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block" href="index.html">
          <img src="{{url('img/logo.png')}}" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
          Laundry Management
        </a>

        <div class="d-flex flex-1 d-block d-md-none">
          <a href="#" class="sidebar-toggle ml-3">
            <i data-feather="menu"></i>
          </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
          <!-- Notifications -->
          <li class="nav-item dropdown">
            <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
              <img src="{{url(($help->image_profile() != '-' ? 'img/profile/'.$help->image_profile() : 'img/logo.png' ))}}" class="d-inline-block align-top" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{ route('home.profile') }}">My Profile</a>
              <!--
              <a class="dropdown-item" href="#">My Tasks</a>
              <a class="dropdown-item" href="#">Settings</a>
              -->
              <div class="dropdown-divider"></div>
              
              <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <!-- // Header -->

      <!-- expand-hover push -->
      <div class="adminx-sidebar expand-hover push" id="sidebar">
        <ul class="sidebar-nav">
          <li class="sidebar-nav-item">
            <a href="{{route('home.dashboard')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="home"></i>
              </span>
              <span class="sidebar-nav-name">
                Dashboard
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            
            @if($help->ifOwner())
            @else
            <a href="{{route('transaksi.index')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="dollar-sign"></i>
              </span>
              <span class="sidebar-nav-name">
                Transaksi Management
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif
            
            @if($help->ifAdmin())
            <a href="{{url('paket')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="box"></i>
              </span>
              <span class="sidebar-nav-name">
                Paket Laundry
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif

            @if($help->ifAdmin())
            <a href="{{url('diskon')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="box"></i>
              </span>
              <span class="sidebar-nav-name">
                Diskon Management
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif
            
            @if($help->ifOwner() || $help->ifKasir())
            @else
            <a href="{{url('outlet')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="shopping-cart"></i>
              </span>
              <span class="sidebar-nav-name">
                Outlet Management
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif

            @if($help->ifAdmin())
            <a href="{{url('user')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="user"></i>
              </span>
              <span class="sidebar-nav-name">
                User Management
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif

            @if($help->ifOwner())
            @else
            <a href="{{url('member')}}" class="sidebar-nav-link">
              <span class="sidebar-nav-icon">
                <i data-feather="user-check"></i>
              </span>
              <span class="sidebar-nav-name">
                Member Management
              </span>
              <span class="sidebar-nav-end">

              </span>
            </a>
            @endif

          </li>
        </ul>
      </div>




      <!-- Main Content -->
      <div class="adminx-content">
        <div class="adminx-main-content">
          <div class="container-fluid">
            <!-- BreadCrumb -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb adminx-page-breadcrumb">
                <li class="breadcrumb-item"><a href="{{url(Request::segment(1))}}">{{Request::segment(1)}}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)" style="color: black;text-decoration: none; cursor: default;">{{Request::segment(2)}}</a></li>
              </ol>
            </nav>



            <div class="pb-3">
              	<!-- bagian judul halaman blog -->
				    <h1> @yield('judul_halaman') </h1>
            
            </div>
            
            <!-- header dashboard -->
            @if(Request::segment(1) == 'home')
              @yield('head_dashborad')
            @endif
            <!-- end header dashboard -->

            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-grid">
                  <div class="card-header">
                    <div class="card-header-title">@yield('judul_halaman')</div>
                  </div>
                  <div class="card-body">

					         @yield('konten')

                  </div>
                </div>
              </div>
            </div>
            <footer>
              <center><p>&copy; <a href="JavaScript:void(0)">LaundryApps</a>. 2020 - 2021</p></center>
            </footer>
          </div>
        </div>
      </div>
      <!-- // Main Content -->
    </div>

	<!-- A -->
 	
	<br/>
	<br/>
	<hr/>
 	
 	    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{url('js/vendor.js')}}"></script>
    <script src="{{url('js/jquery.blockUI.js')}}"></script>
    <script src="{{url('js/adminx.js')}}"></script>



    <!-- If you prefer vanilla JS these are the only required scripts -->
    <!-- script src="../dist/js/vendor.js"></script>
    <script src="../dist/js/adminx.vanilla.js"></script-->

    @yield('scripts')
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          var form = document.getElementById('needs-validation');
          if(form !== null) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          }
        }, false);
      })();
    </script>
    
  <script>
      $('#delete-confirm').on('click', function (event) {
          event.preventDefault();
          const url = $(this).attr('href');
          swal({
              title: 'Are you sure?',
              text: 'This record and it`s details will be permanantly deleted!',
              icon: 'warning',
              buttons: ["Cancel", "Yes!"],
          }).then(function(value) {
              if (value) {
                  window.location.href = url;
              }
          });
      });

      function delaja(id){
        event.preventDefault();
          const url = document.getElementById("dela-"+id).href;
          swal({
              title: 'Anda yakin menghapus data?',
              text: '',
              icon: 'warning',
              buttons: ["Batal", "Ya!"],
          }).then(function(value) {
              if (value) {
                  window.location.href = url;
              }
          });
      }
    </script>
    
    <script>
    $(document).ready(function(){
      $("form").submit(function(){
        $.blockUI({ css: { 
            message: 'Memuat',
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } });
      });
    });
    </script>
    
    <script>
      feather.replace()
    </script>
</body>
</html>