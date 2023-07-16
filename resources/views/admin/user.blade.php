@extends('layouts.admin')
@section('title', $user->username)
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card rounded">
            <div class="card-body bg-success">
                <div class="text-center">
                    <h4>{{ $user->referral_bal }}</h4>
                    <p>Referral Balance</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card rounded">
            <div class="card-body bg-info">
                <div class="text-center">
                    <h4>{{ $user->activity_bal }}</h4>
                    <p>Activity Balance</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card rounded">
            <div class="card-body bg-primary">
                <div class="text-center">
                    <h4>{{ $user->ref_count }}</h4>
                    <p>Total Referrals</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Activate Course</h4>

                <div class="mb-4">
                    <form action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="course">Courses</label>
                            <select name="course_id" id="course" class="form-control">
                                <option value="">Select course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }} - NGN {{ $course->amount }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_id'))
                                <span class="text-danger text-small text-sm">{{ $errors->first('course_id') }}</span>
                            @endif
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Activate Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4 card-title">User Role</h4>
                <form action="/admin/set-role/{{ $user->id }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ $role == $user->role ? 'selected' : '' }}>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if (session()->has('role'))
                        <div class="alert alert-success">{{ session('role') }}</div>
                    @endif
                    <div class="form-group">
                        <button class="btn btn-success btn-block">Change Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Post to user earnings</h4>
                <div class="mb-4">
                    <form action="/admin/post-earning/{{ $user->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                            @if ($errors->has('amount'))
                                <span class="text-danger text-small text-sm">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="task_commission">Tasks Commission</option>
                                <option value="referral_commission">Referral Commission</option>
                            </select>
                            @if ($errors->has('type'))
                                <span class="text-danger text-small text-sm">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                        @if (session()->has('earn'))
                            <div class="alert alert-success">{{ session('earn') }}</div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block">Add to user balance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4 card-title">Course Purchase History</h4>
                <div class="mb-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Course Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_courses as $user_course)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user_course->course->name }}</td>
                                        <td>{{ $user_course->course->amount }}</td>
                                        <td>{{ $user_course->status }}</td>
                                        <td>{{ $user_course->date_activated }}</td>
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
@if ($user->role == 'vendor')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">Assigned Coupons</h4>
                    <div class="mb-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover tb">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Coupon Code</th>
                                        <th>Status</th>
                                        <th>Used By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->coupons as $coupon)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $coupon->code }}</td>
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
@endif
@endsection

@section('scripts')
    <script>
        $('.tb').DataTable()
    </script>
@endsection
