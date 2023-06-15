@extends('layouts.users')
@section('title', 'Withdrawals')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coupon-modal">New Withdrawal</button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
                @foreach ($errors->all() as $err)
                    <div class="alert alert-soft-danger">{{ $err }}</div>
                @endforeach
            @endif
            @if (session()->has('success'))
                <div class="alert alert-soft-success">{{ session('success') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach ($withdrawals as $withdrawal)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="{{ $withdrawal->status == 'approved' ? 'text-primary' : ($withdrawal->status == 'pending' ? 'text-warning' : 'text-danger') }}"> - {{ $withdrawal->type == 'sales' ? 'NGN '. $withdrawal->amount : $withdrawal->amount }} (<span>{{ $withdrawal->status }}</span>)</h5>
                            <p class="lead">From {{ $withdrawal->type }} Balance</p>
                            <p>On {{ $withdrawal->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('modals')
    <div class="modal fade" id="coupon-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Withdrawal</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="" id="check-form" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter withdrawal Amount">
                        </div>
                        <div class="mb-4">
                            <label for="type">Withdrawal Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select withdrawal type</option>
                                <option value="activity">From Activity Earnings</option>
                                <option value="sales">From Sales Earnings</option>
                            </select>
                        </div>
                        <div class="result"></div>
                        <div class="mb-4">
                            <button type="submit" id="btn" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection