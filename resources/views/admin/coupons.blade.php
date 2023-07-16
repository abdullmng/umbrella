@extends('layouts.admin')
@section('title', 'Coupons')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if ($errors->any())
            @foreach ($errors->all() as $err)
                <div class="alert alert-danger">{{ $err }}</div>
            @endforeach
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Coupons</h4>

                <div class="mb-4">
                    <button data-toggle="modal" data-target="#coupons-modal" class="btn btn-primary">Generate Coupons</button>
                </div>

                <div class="mb-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover tb">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Code</th>
                                    <th>Vendor</th>
                                    <th>Status</th>
                                    <th>Used By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->vendor?->username }}</td>
                                        <td><span class="text-{{ $coupon->status_color }}">{{ $coupon->status }}</span></td>
                                        <td>{{ $coupon->used_by }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')
    <div class="modal fade" id="coupons-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Generate Coupons</h4>
                    <a href="#" data-dismiss="modal"="" class="close">&times;</a>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="vendor">Vendor</label>
                            <select name="vendor_id" id="vendor" class="form-control">
                                <option value="">Select Vendor</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }} - {{ $vendor->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no">Number of Coupons</label>
                            <input type="number" name="no" id="no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="amount">Coupon Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.tb').DataTable()
    </script>
@endsection
