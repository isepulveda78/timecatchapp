<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

            <!-- Styles -->
          <link href="{{ asset('css/timeCatch.css') }}" rel="stylesheet">
          <!-- Favicon -->
          <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}">
          <!-- Icons -->
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet">
          <title>TimeCatch</title>
    <body>
       <!-- Navabr -->
   <nav id="navbar-main" class="navbar navbar-horizontal navbar-main navbar-expand-lg navbar-dark bg-primary">
     <div class="container">
       <a class="navbar-brand" href="{{ route('home') }}">
         <img src="img/logo/timeCatchLogo.png"">&nbsp;TimeCatch
       </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
         <div class="navbar-collapse-header">
           <div class="row">
             <div class="col-6 collapse-brand">
               <a href="{{ route('home') }}">
                 <img src="img/logo/timeCatchLogo.png">
               </a>
             </div>
             <div class="col-6 collapse-close">
               <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                 <span></span>
                 <span></span>
               </button>
             </div>
           </div>
         </div>
         <ul class="navbar-nav mr-auto">
           <li class="nav-item">
             <a href="./pages/dashboards/dashboard.html" class="nav-link">
               <span class="nav-link-inner--text">What is time catch?</span>
             </a>
           </li>
           <li class="nav-item">
             <a href="./pages/examples/pricing.html" class="nav-link">
               <span class="nav-link-inner--text">How it works</span>
             </a>
           </li>
           @guest
           <li class="nav-item">
             <a href="{{ route('login') }}" class="nav-link">
               <span class="nav-link-inner--text">{{ __('Login') }}</span>
             </a>
           </li>
           @if (Route::has('register'))
           <li class="nav-item">
             <a href="{{ route('register') }}" class="nav-link">
               <span class="nav-link-inner--text">Register</span>
             </a>
           </li>
           @endif
            @else
           <li class="nav-item">
             <a href="{{ route('tasks') }}" class="nav-link">
               <span class="nav-link-inner--text">Dashboard</span>
             </a>
           </li>
           <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link js-scroll-trigger" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
              </li>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          @endguest
         </ul>
         <hr class="d-lg-none" />
         <ul class="navbar-nav align-items-lg-center ml-lg-auto">
           <li class="nav-item">
             <a class="nav-link nav-link-icon" href="" target="_blank" data-toggle="tooltip" title="" data-original-title="Like us on Facebook">
               <i class="fab fa-facebook-square"></i>
               <span class="nav-link-inner--text d-lg-none">Facebook</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link nav-link-icon" href="" target="_blank" data-toggle="tooltip" title="" data-original-title="Follow us on Instagram">
               <i class="fab fa-instagram"></i>
               <span class="nav-link-inner--text d-lg-none">Instagram</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link nav-link-icon" href="" target="_blank" data-toggle="tooltip" title="" data-original-title="Follow us on Twitter">
               <i class="fab fa-twitter-square"></i>
               <span class="nav-link-inner--text d-lg-none">Twitter</span>
             </a>
           </li>
           <li class="nav-item">
             <a class="nav-link nav-link-icon" href="" target="_blank" data-toggle="tooltip" title="" data-original-title="Star us on Github">
               <i class="fab fa-github"></i>
               <span class="nav-link-inner--text d-lg-none">Github</span>
             </a>
           </li>
         </ul>
       </div>
     </div>
   </nav>
   <!-- Main content -->
   <div class="main-content">
     <!-- Header -->
     <div class="header bg-primary pt-5 pb-7">
       <div class="container">
         <div class="header-body">
           <div class="row align-items-center">
             <div class="col-lg-6">
               <div class="pr-5">
                 <h1 class="display-2 text-white font-weight-bold mb-0">Freelancers & Consultants</h1>
                 <h2 class="display-4 text-white font-weight-light">Save time to earn more.</h2>
                 <p class="text-white mt-4">Do your routine administrative tasks add value, help you earn more, 
                   allow you to serve your clients better? Or should you be investing  the time developing your skills and producing 
                   great work for your clients while increasing your billable hours?</p>
                 <div class="mt-5">
                   <a href="{{ route('register') }}" class="btn btn-neutral my-2">Sign up!</a>
                 </div>
               </div>
             </div>
             <div class="col-lg-6">
               <div class="row pt-5">
                 <div class="col-md-12">
                   <div class="card">
                     <div class="card-body">
                       <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow mb-4">
                       <i class="fas fa-clock"></i>
                       </div>
                       <h5 class="h3">TimeCatchApp</h5>
                       <p>is designed to help you do more of what you love, spend less time and energy on paperwork, 
                         and become more efficient so that you can spend your time on your priorities.</p>
                     </div>
                   </div>
                   </div>
                 </div>
               </div>
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
     <section class="py-6 pb-9 bg-default">
       <div class="row justify-content-center text-center">
         <div class="col-md-6">
           <h2 class="display-3 text-white">What is time catch?</h3>
         </div>
       </div>
     </section>
     <section class="section section-lg pt-lg-0 mt--7">
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-lg-12">
             <div class="row">
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-primary text-white rounded-circle mb-4">
                     <i class="fas fa-calendar-day"></i>
                     </div>
                     <h4 class="h3 text-primary text-uppercase">Need more time in your day?</h4>
                     <p class="description mt-3">TimeCatchApp is designed to save freelancers and consultants time by automating your tracking and management tasks that you need to do. 
                       Using the app can save you time so that you can spend it more productively.</p>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-success text-white rounded-circle mb-4">
                     <i class="fas fa-tools"></i>
                     </div>
                     <h4 class="h3 text-success text-uppercase">IManagement tools for freelancers & consultants</h4>
                     <p class="description mt-3">Freelancers and consultants need effective tools to manage their projects and their work day. 
                       Measurement leads to improvement. And TimeCatchApp makes it easy.</p>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-warning text-white rounded-circle mb-4">
                     <i class="fas fa-users"></i>
                     </div>
                     <h4 class="h3 text-warning text-uppercase">Recruit a great team</h4>
                     <p class="description mt-3">Need a team member with a different skill? No problem. Invite another freelancer to join 
                       your project, track their time, and manage invoicing and payables automatically.</p>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
    
     <section class="py-7 section-nucleo-icons bg-white overflow-hidden">
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-lg-8 text-center">
             <h2 class="display-3">Why are we creating this app?</h2>
             <p class="lead text-justify">
             TimeCatchApp was founded by a former executive of a Fortune 500 company. He was responsible for the P&L of a multimullion 
             dollar scientific consulting organization. He had tools and processes to manage the business that freelancers do have access to, but could you to better manager the business. Hence TimeCatchApp was born, to bring easy-to-use software to help freelance and small consulting groups more professionally manage their business, work more efficiently and spend more time doing what they love.
              Want to join in creating great tools for freelancers? Join now! And it's free for the first 500 users!
             </p>
           </div>
         </div>
         
     </section>
    
   </div>
   <!-- Footer -->
   <footer class="py-5 bg-white" id="footer-main">
     <div class="container">
       <div class="row align-items-center justify-content-xl-between">
         <div class="col-xl-6">
           <div class="copyright text-center text-xl-left text-muted">
             &copy; 2019 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">TimeCatch</a>
           </div>
         </div>
       </div>
     </div>
   </footer>
    </body>
</html>
