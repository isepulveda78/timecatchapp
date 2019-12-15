<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="mainNav">
        <img src="img/logo/timeCatchLogo.png" alt="TimeCatch App" class="img-fluid" style="max-width: 3rem;">
          <a class="navbar-brand js-scroll-trigger logo" href="{{ url('/') }}">&nbsp;TimeCatch App</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#about">What is TimeCatch</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#how">How it works</a>
              </li>
              @guest
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              @if (Route::has('register'))
                <li class="nav-item">
                  <a href="{{ route('register') }}" class="nav-link js-scroll-trigger btn btn-outline-success" >Sign Up!</a>
                </li>
              @endif
            @else
                <li class="nav-item">
                  <a href="/dashboard" class="nav-link">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link js-scroll-trigger btn btn-outline-success" 
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @endguest
            </ul>
          </div>
</nav>