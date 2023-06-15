@extends('layouts.users')
@section('title', 'Vendor Dashboard')
@section('content')
    <div class="row mb-4">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Total Coupons</h3>
                        <p class="lead">{{ $stats['total_coupons'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Total Used</h3>
                        <p class="lead">{{ $stats['total_used'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>Total Unused</h3>
                        <p class="lead">{{ $stats['total_unused'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h4>Coupons</h4>
            </div>
            <div class="result">

            </div>
            <div class="table-responsive mb-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Code</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Used By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><input type="text" class="form-control coupon" value="{{ $coupon->code }}" readonly></td>
                                <td>NGN {{ number_format($coupon->amount) }}</td>
                                <td><span class="badge badge-pill bg-{{ $coupon->status_color }}">{{ $coupon->status }}</span></td>
                                <td>{{ $coupon->used_by }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <!-- Pagination -->
                <nav class="d-flex justify-content-center" aria-label="Page navigation">
                    {{ $coupons->links() }}
                </nav>
                <!-- End Pagination -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script> 
        $('body').on('click', '.coupon', function () {
            $(this).select()
            document.execCommand('copy')
            $('.result').html(`<div class="alert alert-soft-success alert-dismissible"><a class="btn-close" href="javascript:void" data-bs-dismiss="alert"></a>Coupon Copied</div>`)
        })
    </script>
@endsection
