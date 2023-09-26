@extends('layouts.users')
@section('title', 'Top Sellers')
@section('content')
    <div class="row mb-4">
        @foreach ($earners as $earner)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-5 p-2">
                                <img class="avatar avatar-lg avatar-circle" src="{{ $earner->user->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
                            </div>
                            <div class="col-7 p-2">
                                <p><strong>{{ $earner->user->username }}</strong> <br> NGN {{ $earner->amt }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        <!-- Pagination -->
        <nav class="d-flex justify-content-center" aria-label="Page navigation">
            {{ $earners->links() }}
            <!-- End Col -->
        </nav>
        <!-- End Pagination -->
    </div>
@endsection
