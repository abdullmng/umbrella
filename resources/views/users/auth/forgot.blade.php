@extends('layouts.auth')
@section('title', "Login")
@section('content')
<form class="" method="POST">
    @csrf
  <div class="text-center">
    <div class="mb-5">
      <h3 class="card-title">Request password reset</h3>
      @if ($errors->has('error'))
          <div class="alert alert-danger">{{ $errors->first('error') }}</div>
      @endif
      @if (session()->has('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
      @endif
    </div>
  </div>

  <!-- Form -->
  <div class="mb-4">
    <label class="form-label" for="signinSrEmail">Your Email</label>
    <input type="text" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="Email address">
    @if ($errors->has('email'))
        <span class="text-danger text-small text-sm">{{ $errors->first('email') }}</span>
    @endif
    <span class="invalid-feedback">Please enter a valid email address.</span>
  </div>
  <!-- End Form -->


  <div class="d-flex justify-content-end mb-4">
    <a class="form-label-link" href="/users/login">Back to Login?</a>
  </div>

  <div class="d-grid gap-4">
    <button type="submit" class="btn btn-primary btn-lg">Request Link</button>
    <p class="card-text text-muted">Don't have an account yet? <a class="link" href="/users/register">Sign up here</a></p>
  </div>
</form>
@endsection
