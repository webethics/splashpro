@extends('frontend.layouts.landing')
@section('pageTitle','Landing')
@section('content')
<div class="content-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-12">
        <div class="card mb-4 box-shadow"> <img src="{{asset('frontend/images/img1.jpg')}}" class="img-fluid" alt="Responsive image">
          <div class="card-body crdb-txt">
            <h3> Traffics </h3>
            <p class="card-text">Supercharge the traffic to your site and generate more business. Our paid ad systems aren't like the other guys.</p>
            <a href="#"> Packages </a> </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="card mb-4 box-shadow"> <img src="{{asset('frontend/images/img2.jpg')}}" class="img-fluid" alt="Responsive image">
          <div class="card-body crdb-txt">
            <h3> Leads </h3>
            <p class="card-text">Supercharge the traffic to your site and generate more business. Our paid ad systems aren't like the other guys.</p>
            <a href="#"> Packages </a> </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection