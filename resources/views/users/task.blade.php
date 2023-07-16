@extends('layouts.users')
@section('title', 'Task')
@section('page-desc', 'Complete task and share to earn.')
@section('content')
<div class="row">
  <div class="col-lg-9">
    <div class="row justify-content-lg-center">
      <div class="col-lg-12">
        <div class="mb-6">
          <h1 class="h2">{{ $task->name }}</h1>
        </div>
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->

    <div class="row justify-content-lg-center mb-6">
      <div class="col-lg-12">
        <img class="img-fluid" src="{{ $task->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
    <div class="row justify-content-lg-center mb-3">
      <div class="col-lg-12">
        {!! $task->content !!}
      </div>
      <!-- End Col -->
    </div>
    <!-- End Row -->
  </div>
  <div class="col-lg-3">
    <div class="row">
      <div class="col-md-12">
        @if ($errors->any())
            @foreach ($errors->all() as $err)
                <div class="alert alert-soft-danger">{{ $err }}</div>
            @endforeach
        @endif
        @if (session()->has('success'))
        <div class="alert alert-soft-success">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
          <h3 class="mb-6">Share Task</h3>
          @if (auth()->check())
            <a href="#" class="btn btn-info w-100 share mb-4" target="__blank">Share</a>
            <form action="/users/earn" method="post" class="earn-form" style="display: none">
                @csrf
                <input type="hidden" name="task_id" value="{{ $task->id }}">
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100">
                        Earn {{ $task->amount }}
                    </button>
                </div>
            </form>
          @else
            <a href="{{ route('user.login') }}" class="btn btn-primary w-100">Login to share</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
    <script>
        $('.share').click(function () {
            $('.earn-form').show()
        })
    </script>
@endsection
