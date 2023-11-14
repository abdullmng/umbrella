@extends('layouts.users')
@section('title', 'Invoices')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">My Invoices</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        S/N
                                    </th>
                                    <th>
                                        Course
                                    </th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->course->name }}</td>
                                        <td>{{ $invoice->amount }}</td>
                                        <td>{{ $invoice->status }}</td>
                                        <td><a href="/users/invoices/{{ $invoice->id }}" class="btn btn-sm btn-primary">View Invoice</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($invoice->status == 'unpaid')
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <form action="" id="pay-form">
                                <input type="hidden" id="amount" value="{{ $invoice->amount }}">
                                <input type="hidden" id="ref" value="{{ $invoice->invoice_number }}">
                                <button type="submit" class="btn btn-primary w-100">Pay Now</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
