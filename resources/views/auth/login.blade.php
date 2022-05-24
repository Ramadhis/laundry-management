<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Laundry Management - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{url('css/adminx.css')}}" type="text/css" rel="stylesheet" media="screen"/>
  </head>
  <body>
    <div class="adminx-container d-flex justify-content-center align-items-center">
      <div class="page-login">
        <div class="text-center">
          <a class="navbar-brand mb-4 h1" href="login.html">
            <img src="{{url('img/logo.png')}}" class="navbar-brand-image d-inline-block align-top mr-2" alt="">
            Laundry Management
          </a>
        </div>
        <div class="card mb-0">
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <!-- form-label -->
                <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                <!--
                <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              
              <div class="form-group">
                <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                
                <!--<input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                -->
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <!--
                  <input type="checkbox" class="custom-control-input" id="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Remember me</label>
                  -->
                  <input class="form-check-input custom-control-inpu" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </label>

                </div>
              </div>
              <!--
              <button type="submit" class="btn btn-sm btn-block btn-primary">Sign in</button>
              -->
              <button type="submit" class="btn btn-sm btn-block btn-primary">
                  {{ __('Login') }}
              </button>
            </form>
          </div>
          <div class="card-footer text-center">
            <a href="#"><small>Forgot your password?</small></a>
          </div>
        </div>
      </div>
    </div>

    <!-- If you prefer jQuery these are the required scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
    <script src="{{url('js/vendor.js')}}"></script>
    <script src="{{url('js/adminx.js')}}"></script>

    <!-- If you prefer vanilla JS these are the only required scripts -->
    <!-- script src="../dist/js/vendor.js"></script>
    <script src="../dist/js/adminx.vanilla.js"></script-->
  </body>
</html>
