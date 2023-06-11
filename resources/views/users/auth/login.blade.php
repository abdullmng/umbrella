@extends('layouts.auth')
@section('title', "Login")
@section('content')
<form class="" method="POST">
    @csrf
  <div class="text-center">
    <div class="mb-5">
      <h3 class="card-title">Login to {{ config('app.name') }}</h3>
      @if ($errors->has('error'))
          <div class="alert alert-danger">{{ $errors->first('error') }}</div>
      @endif
    </div>
  </div>

  <!-- Form -->
  <div class="mb-4">
    <label class="form-label" for="signinSrEmail">Your Email/Username</label>
    <input type="email" class="form-control form-control-lg" name="username" id="signinSrEmail" tabindex="1" placeholder="email@address.com/username" aria-label="email@address.com" required>
    @if ($errors->has('username'))
        <span class="text-danger text-small text-sm">{{ $errors->first('username') }}</span>
    @endif
    <span class="invalid-feedback">Please enter a valid email address.</span>
  </div>
  <!-- End Form -->

  <!-- Form -->
  <div class="mb-4">
    <label class="form-label" for="signupSrPassword" tabindex="0">Password</label>

    <div class="input-group-merge">
      <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Enter your password">
      <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
        <i id="changePassIcon" class="bi-eye"></i>
      </a>
        @if ($errors->has('password'))
            <span class="text-danger text-small text-sm">{{ $errors->first('password') }}</span>
        @endif
      <span class="invalid-feedback">Please enter a valid password.</span>
    </div>
  </div>
  <!-- End Form -->

  <div class="d-flex justify-content-end mb-4">
    <a class="form-label-link" href="/users/forgot">Forgot Password?</a>
  </div>

  <div class="d-grid gap-4">
    <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
    <p class="card-text text-muted">Don't have an account yet? <a class="link" href="/users/register">Sign up here</a></p>
  </div>
</form>
@endsection