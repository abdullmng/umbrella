@extends('layouts.users')
@section('title', 'Get Coupon')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#coupon-modal">Check Coupon Validity</button>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($vendors as $vendor)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img class="avatar avatar-xxl avatar-circle mb-3" src="{{ $vendor->image ?? '/assets/img/160x160/img10.jpg' }}" alt="Image Description">
                            <h5>{{ $vendor->name }}</h5>
                            <p class="lead">{{ !is_null($vendor->bank) ? explode('-', $vendor->bank)[1] : 'NA' }}</p>
                            <a href="https://wa.me/{{ $vendor->phone_number }}" class="btn btn-outline-primary w-100"><i class="bi bi-whatsapp"></i></a>
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
                    <h4 class="modal-title">Check Coupon Validity</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="" id="check-form">
                        @csrf
                        <div class="mb-4">
                            <label for="coupon">Coupon</label>
                            <input type="text" name="coupon" id="coupon" class="form-control" placeholder="Enter Coupon Code">
                        </div>
                        <div class="result"></div>
                        <div class="mb-4">
                            <button type="submit" id="btn" class="btn btn-primary">Check</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#check-form').submit(function (e) {
            e.preventDefault()
            let data = $(this).serialize()
            let btn = $('#btn')
            $.ajax({
                url: '/api/check-coupon',
                type: 'POST',
                data: data,
                beforeSend: () => {
                    btn.html('checking...')
                    btn.attr('disabled', 'true')
                },
                success: (res) => {
                    if (res.error)
                    {
                        $('.result').html(`<div class="alert alert-soft-danger">${res.msg}</div>`)
                    }
                    else 
                    {
                        $('.result').html(`<div class="alert alert-soft-success">${res.msg}</div>`)
                    }
                    btn.html('Check')
                    btn.removeAttr('disabled')
                },
                error: (err) => {
                    $('.result').html(`<div class="alert alert-soft-danger">${err.status} <br> ${err.statusText}</div>`)
                    btn.html('Check')
                    btn.removeAttr('disabled')
                }
            })
        })
    </script>
@endsection