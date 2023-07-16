@extends('layouts.users')
@section('title', 'Course')
@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="row justify-content-lg-center">
      <div class="col-lg-12">
        <div class="mb-6">
          <h1 class="h2">{{ $course->name }} (NGN {{ number_format($course->amount) }})</h1>
          <p class="lead">{{ $course->short_description }}</p>
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->

    <div class="row justify-content-lg-center mb-6">
      <div class="col-lg-12">
        <img class="img-fluid" src="{{ $course->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
    <div class="row justify-content-lg-center mb-3">
      <div class="col-lg-12">
        {!! $course->description !!}
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <div class="col-lg-3">
    <div class="row">
      <div class="col-md-12">
        <div class="mb-4">
          <h3 class="mb-6">NGN {{ number_format($course->amount) }}</h3>
          @if (auth()->check())
            @if (auth()->user()->user_courses->where('course_id', $course->id)->first())
              <a href="#" class="btn btn-primary w-100">Join Course Channel</a>
            @else
              <form action="" method="post">
                @csrf
                <div class="mb-4">
                  <label for="coupon">Coupon</label>
                  <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Enter Coupon Code">
                  <input type="hidden" name="course_id" value="{{ $course->id }}">
                </div>
                <div class="mb-4">
                  <button type="submit" class="btn btn-primary w-100">Activate Course</button>
                </div>
              </form>
            @endif
          @else
            <a href="{{ route('user.login') }}" class="btn btn-primary w-100">Login to activate course</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
