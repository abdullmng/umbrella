@extends('layouts.users')
@section('title', 'Top Sellers')
@section('content')
    <div class="row">
        @foreach ($earners as $earner)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="avatar avatar-xxl avatar-circle mb-3" src="{{ $earner->user->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
                            <h5>{{ $earner->user->username }}</h5>
                            <p class="lead">NGN {{ $earner->amt }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
