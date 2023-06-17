@extends('layouts.users')
@section('title', 'Verify Social Accounts')
@section('content')
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h4>Users</h4>
            </div>
            <div class="result">

            </div>
            <div class="table-responsive mb-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->user->name }}</td>
                                <td>{{ $user->user->username }}</td>
                                <td><a href="{{ route('super.verify_user_socials', $user->user_id) }}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <!-- Pagination -->
                <nav class="d-flex justify-content-center" aria-label="Page navigation">
                    {{ $users->links() }}
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
