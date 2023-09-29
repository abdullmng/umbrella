@extends('layouts.users')
@section('title', 'Activity')
@section('page-desc', 'All your activity history in one place.')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h4>Tasks Commission</h4>
            <div class="row mb-6">
                @foreach ($earnings->where('type', 'task_commission') as $task_earn)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body p-2">
                                <h4 class="mb-0">{{ $task_earn->amount }}</h4>
                                <p class="text-sm text-small mb-0">{{ $task_earn->day }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <h4>Sales Commission</h4>
            <div class="row mb-6">
                @foreach ($earnings->where('type', 'referral_commission') as $task_earn)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body p-2">
                                <h4 class="mb-0">{{ $task_earn->amount }}</h4>
                                <p class="text-sm text-small mb-0">{{ $task_earn->day }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <nav class="d-flex justify-content-center" aria-label="Page navigation">
        {{ $earnings->links() }}
    </nav>
    <!-- End Pagination -->
@endsection
