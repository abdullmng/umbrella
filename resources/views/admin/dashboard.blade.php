@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')


<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card bg-primary border-primary">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">Total</span>
                    <h5 class="card-title mb-0 text-white">Users</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center mb-0 text-white">
                            {{ $stat['users'] }}
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">12.5% <i class="mdi mdi-arrow-up"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 5px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 38%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-success border-success">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">Total</span>
                    <h5 class="card-title mb-0 text-white">Coupon Merchants</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            {{ $stat['vendors'] }}
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">18.71% <i class="mdi mdi-arrow-down"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 38%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-warning border-warning">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">total</span>
                    <h5 class="card-title mb-0 text-white">Courses</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            {{ $stat['courses'] }}
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">57% <i class="mdi mdi-arrow-up"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 68%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card bg-info border-info">
            <div class="card-body">
                <div class="mb-4">
                    <span class="badge badge-soft-light float-right">total</span>
                    <h5 class="card-title mb-0 text-white">Coupons</h5>
                </div>
                <div class="row d-flex align-items-center mb-4">
                    <div class="col-8">
                        <h2 class="d-flex align-items-center text-white mb-0">
                            {{ $stat['coupons'] }}
                        </h2>
                    </div>
                    <div class="col-4 text-right">
                        <span class="text-white-50">17.8% <i class="mdi mdi-arrow-down"></i></span>
                    </div>
                </div>

                <div class="progress badge-soft-light shadow-sm" style="height: 7px;">
                    <div class="progress-bar bg-light" role="progressbar" style="width: 57%;"></div>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div>
<!-- end row -->

<div class="row">

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-right position-relative">
                    <a href="#" class="dropdown-toggle h4 text-muted reload" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
                <h4 class="card-title d-inline-block">Courses</h4>

                <div class="text-center"><p class="loader">please wait..</p></div>
                <canvas id="barChart"></canvas>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h4 class="tt_rev"></h4>
                        <p class="text-muted mb-0">Total Revenue</p>
                    </div>
                    <div class="col-6">
                        <h4 class="tt_purchases"></h4>
                        <p class="text-muted mb-0">Total Purchases</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-right position-relative">
                    <a href="#" class="dropdown-toggle h4 text-muted reload" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="mdi mdi-refresh"></i>
                    </a>
                </div>
                <h4 class="card-title d-inline-block">Coupon Sales</h4>

                <div class="text-center"><p class="loader">please wait..</p></div>
                <canvas id="pieChart"></canvas>

                <div class="row text-center mt-4">
                    <div class="col-6">
                        <h4 class="tt_used">0</h4>
                        <p class="text-muted mb-0">Total Sales</p>
                    </div>
                    <div class="col-6">
                        <h4 class="tt_unused">0</h4>
                        <p class="text-muted mb-0">Open Compaign</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row-->

@endsection

@section('scripts')
    <script src="/other/chart.js"></script>
@endsection
