@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<form method="POST">
    @csrf
    <input type="hidden" name="ref" value="{{ request()->get('ref') ?? '' }}">
    <div class="text-center">
      <div class="mb-5">
        <h3 class="card-title">Create your account</h3>
        @if ($errors->has('error'))
            <div class="alert alert-danger">{{ $errors->first('error') }}</div>
        @endif
        @if (request()->has('ref'))
            <p>Referrer: {{ request()->get('ref') }}</p>
        @endif
      </div>
    </div>

    <div class="mb-4">
        <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Full Name" >
        @if ($errors->has('name'))
            <span class="text-danger text-small text-sm">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <!-- Form -->
    <div class="mb-4">
      <input type="email" class="form-control form-control-lg" name="email" id="signupSrEmail" placeholder="Email Address" >
      @if ($errors->has('email'))
          <span class="text-danger text-small text-sm">{{ $errors->first('email') }}</span>
      @endif
    </div>
  <!-- End Form -->

    <!-- Form -->
    <div class="row">
      <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username" >
            @if ($errors->has('username'))
                <span class="text-danger text-small text-sm">{{ $errors->first('username') }}</span>
            @endif
        </div>
        <!-- End Form -->
      </div>

      <div class="col-sm-6">
        <!-- Form -->
        <div class="mb-4">
            <input type="text" class="form-control form-control-lg" name="phone_number" id="phone" placeholder="Phone number" >
            @if ($errors->has('phone_number'))
                <span class="text-danger text-small text-sm">{{ $errors->first('phone_number') }}</span>
            @endif
        </div>
        <!-- End Form -->
      </div>
    </div>
    <!-- End Form -->

    <div class="row">
      <div class="col-md-6">
        <!-- Form -->
        <div class="mb-4">
          <div class="input-group-merge">
            <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Enter password" >

            @if ($errors->has('password'))
                <span class="text-danger text-small text-sm">{{ $errors->first('password') }}</span>
            @endif
          </div>
        </div>
        <!-- End Form -->
      </div>
      <div class="col-md-6">
        <!-- Form -->
        <div class="mb-4">
          <div class="input-group-merge">
            <input type="password" class="js-toggle-password form-control form-control-lg" name="password_confirmation" id="signupSrConfirmPassword" placeholder="Confirm password">
            @if ($errors->has('password_confirmation'))
                <span class="text-danger text-small text-sm">{{ $errors->first('password_confirmation') }}</span>
            @endif
          </div>
        </div>
        <!-- End Form -->
      </div>
    </div>

    <div class="mb-4">
      <div class="input-group-merge">
        <input type="text" class="form-control form-control-lg" id="course" placeholder="Course" value="{{ $course->name }} (NGN {{ $course->amount }})" readonly>
      </div>
    </div>
    <!-- Form -->
    {{--<div class="mb-4">
      <div class="input-group-merge">
        <input type="text" class="form-control form-control-lg" name="coupon" id="coupon" placeholder="Enter your coupon code">
        @if ($errors->has('coupon'))
            <span class="text-danger text-small text-sm">{{ $errors->first('coupon') }}</span>
        @endif
      </div>
    </div>--}}
    <!-- End Form -->

    <!-- Form Check -->
    <div class="form-check mb-4">
      <input class="form-check-input" type="checkbox" value="" id="termsCheckbox" required>
      <label class="form-check-label" for="termsCheckbox">I accept the <a href="#">Terms and Conditions</a></label>
      <span class="invalid-feedback">Please accept our Terms and Conditions.</span>
    </div>
    <!-- End Form Check -->

    <div class="d-grid gap-4">
      <button type="submit" class="btn btn-primary btn-lg">Create an account</button>
      <p class="card-text text-muted">Remember your password? <a class="link" href="{{ route('user.login') }}">Log in</a></p>
    </div>
  </form>
@endsection
