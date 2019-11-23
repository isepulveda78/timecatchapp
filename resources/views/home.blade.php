@extends('layouts.app')

@section('content')

@include('partials._navigation')

<header class="bg-primary text-white">
        <div class="container text-center">
          <h1 class="text-white header-slogan">Employee Time Tracker</h1>
          <p class="lead">Track time with your colleagues.</p>
          <a  href="admin.html" class="btn btn-success">Let's get started!</a>
        </div>
      </header>
    
      <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                  <h2 class="section-heading text-uppercase mb-1">What's TimeCatch?</h2>
                </div>
              </div>
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <p class="lead">Do your routine administrative tasks add value, help you earn more, allow you to serve your clients better? Or should you be investing  the time developing your skills and producing great work for your clients while increasing your billable hours?<br/>
              TimeCatchApp is designed to help you do more of what you love, spend less time and energy on paperwork, and become more efficient so that you can spend your time on your priorities.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Services -->
  <section class="page-section bg-lighter" id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase mb-1">What can TimeCatch do for you?</h2><br>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="far fa-clock fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Saves you time</h4>
          <p class="text-muted">TimeCatchApp is designed to save freelancers and consultants time by automating your tracking and management tasks that you need to do. 
            Using the app can save you time so that you can spend it more productively.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-tools fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Provides tools for freelancers & consultants</h4>
          <p class="text-muted">Freelancers and consultants need effective tools to manage their projects and their work day. Measurement leads to improvement. And TimeCatchApp makes it easy.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-primary"></i>
            <i class="fas fa-user-friends fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Allows you to recruit a team</h4>
          <p class="text-muted">Need a team member with a different skill? No problem. Invite another freelancer to join your project, track their time, and manage invoicing and payables automatically.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 bg-primary">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>


 
@endsection