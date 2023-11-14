@extends('layouts.users')
@section('title', 'Invoice')
@section('page-desc')
    <p>Invoice #{{ $invoice->invoice_number }}</p>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <span class="mb-4 p-2 rounded rounded-pill {{ $invoice->status=='paid' ? 'bg-success text-white': 'bg-danger text-white' }}">
                    {{ $invoice->status }}
                </span>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>
                                    S/N
                                </th>
                                <th>
                                    Item - Description
                                </th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>
                                    {{ $invoice->course->name }} -
                                    {{ $invoice->description }}
                                </td>
                                <td>
                                    NGN {{ number_format($invoice->amount, 2) }}
                                </td>
                            </tr>
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
@section('scripts')
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
    $('#pay-form').submit(function (e) {
        e.preventDefault()
        let ref = $('#ref').val()
        let amount = $("#amount").val()
        FlutterwaveCheckout({
            public_key: "{{ env('FLUTTERWAVE_PUBLIC') }}",
            tx_ref: ref,
            amount: Number(amount),
            currency: "NGN",
            payment_options: "card, banktransfer, ussd",
            customer: {
                email: "{{ auth()->user()->email }}",
                phone_number: "{{ auth()->user()->phone_nummber }}",
                name: "{{ auth()->user()->name }}",
            },
            customizations: {
                title: "{{ $invoice->course->name }}",
                description: "{{ $invoice->description }}",
                logo: "{{ $invoice->course->image }}",
            },
        });
    })
</script>
@endsection
