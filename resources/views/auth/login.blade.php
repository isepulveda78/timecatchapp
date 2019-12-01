@extends('layouts.app')

@section('content')

<div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="{{ route('home') }}">
          <img src="img/logo/timeCatchLogo.png" />&nbsp; TimeCatch
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">

          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.html">
                  <img src="img/logo/timeCatchLogo.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>

          <!-- Navbar item -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('register') }}">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-inner--text">Register</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End of Navbar -->

        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                    <h1 class="text-white">Welcome!</h1>
                    <p class="text-lead text-light">Let's track that time.</p>
                    </div>
                </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- End of Header -->


            <!-- Page content -->
            <div class="container mt--9 pb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7"> 
                        <div class="card bg-secondary shadow border-0">
                            <div class="card-header bg-transparent pb-5">

                                 <div class="text-muted text-center mt-2 mb-3"><small>{{ __('Login') }}</small></div>
                                    <div class="btn-wrapper text-center">
                                        <a href="{{ url('login/facebook') }}" class="btn btn-neutral btn-icon facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        <span class="btn-inner--text">Facebook</span>
                                        </a>
                                        <a href="{{ url('login/google') }}" class="btn btn-neutral btn-icon google">
                                            <i class="fab fa-google"></i>
                                        <span class="btn-inner--text">Google</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-muted mb-4">
                                        <small>Or sign in with credentials</small>
                                    </div>
                                <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                         <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-envelope-open"></i></span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">
                                             <span class="text-muted">{{ __('Remember Me') }}</span>
                                        </label>
                                </div>

                    
                     
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
              </div>

        <!-- Footer -->
        <footer class="py-5">
              <div class="container">
                <div class="row align-items-center justify-content-xl-between">
                  <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                      © 2019 <a href="#" class="font-weight-bold ml-1" target="_blank">TimeCatch</a>
                    </div>
                  </div>
                </div>
              </div>
            </footer>
          </div>
@endsection
