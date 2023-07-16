@extends('layouts.users')
@section('title', 'Tasks')
@section('page-desc', 'Complete tasks to earn activity points')
@section('content')
<!-- Card Grid -->
<div class="container content-space-b-2 content-space-b-lg-3 overflow-hidden">
    <div class="row justify-content-md-center mb-5">
        <div class="col-md-8">
            <div class="">
            <div class="mb-4">
                @foreach ($tasks as $task)
                    <!-- Card -->
                    <a class="card card-ghost card-transition-zoom" href="/tasks/{{ $task->id }}">
                    <div class="card-transition-zoom-item">
                        <img class="card-img" src="{{ $task->image ?? '/assets/img/1920x1080/img3.jpg' }}" alt="Image Description">
                    </div>

                    <div class="card-body">
                        <h4>{{ $task->name }}</h4>
                    </div>

                    <div class="card-footer">
                        <span class="card-link">View Details</span>
                    </div>
                    </a>
                    <!-- End Card -->
                @endforeach
            </div>
            </div>
        </div>
        <!-- End Col -->
    </div>

    <!-- Pagination -->
    <nav class="d-flex justify-content-center" aria-label="Page navigation">
    {{ $tasks->links() }}
    <!-- End Col -->
    </nav>
    <!-- End Pagination -->
</div>
@endsection
