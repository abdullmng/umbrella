@extends('layouts.auth')
@section('title', "Login")
@section('content')
<form class="" method="POST">
    @csrf
  <div class="text-center">
    <div class="mb-5">
      <h3 class="card-title">Reset you password</h3>
      @if ($errors->has('error'))
          <div class="alert alert-danger">{{ $errors->first('error') }}</div>
      @endif
      @if (session()->has('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
      @endif
    </div>
  </div>
  <input type="hidden" name="email" value="{{ request()->get('email') }}">
  <input type="hidden" name="token" value="{{ request()->get('token') }}">
  <!-- Form -->
  <div class="mb-4">
    <label class="form-label" for="signupSrPassword" tabindex="0">Password</label>

    <div class="input-group-merge">
      <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Enter your password">
        @if ($errors->has('password'))
            <span class="text-danger text-small text-sm">{{ $errors->first('password') }}</span>
        @endif
        @if ($errors->has('email'))
            <span class="text-danger text-small text-sm">{{ $errors->first('email') }}</span>
        @endif
      <span class="invalid-feedback">Please enter a valid password.</span>
    </div>
  </div>
  <!-- End Form -->

  <!-- Form -->
  <div class="mb-4">
    <label class="form-label" for="signupSrPassword1" tabindex="0">Confirm Password</label>

    <div class="input-group-merge">
      <input type="password" class="js-toggle-password form-control form-control-lg" name="password_confirmation" id="signupSrPassword1" placeholder="Enter your password">
        @if ($errors->has('password_confirmation'))
            <span class="text-danger text-small text-sm">{{ $errors->first('password_confirmation') }}</span>
        @endif
      <span class="invalid-feedback">Password does not match.</span>
    </div>
  </div>
  <!-- End Form -->

  <div class="d-flex justify-content-end mb-4">
    <a class="form-label-link" href="/users/login">back to login</a>
  </div>

  <div class="d-grid gap-4">
    <button type="submit" class="btn btn-primary btn-lg">Reset</button>
    <p class="card-text text-muted">Don't have an account yet? <a class="link" href="/users/register">Sign up here</a></p>
  </div>
</form>
@endsection
