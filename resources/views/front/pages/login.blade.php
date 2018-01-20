@extends('front.layout.layout')
@section('content')
<div class="login-box" style="margin-top:50px;">
  <div class="login-box-body">
    <div class="carewell-logo">
      <img src="/images/front/carewell-logo.jpg" alt="carewell-logo">
    </div>
    <hr>
    <div class="welcome-login">
      <a href="/">WELCOME TO <b>Carewell</b></a>
    </div>
    <hr>
    @if (Session::has('error'))
      <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <form action="/login_submit" method="post">
      {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <hr>
      <div class="row ">
        <div class="front-button">
          <button type="submit" class=" btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
      <div class="row front-text">
        <a href="#">I forgot my password</a><br>
        <a href="/register" class="text-center">Register a new membership</a>
      </div>
    </form>
  </div>
</div>
@endsection