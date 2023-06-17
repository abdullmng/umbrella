@extends('layouts.users')
@section('title', $user->username)
@section('content')
    <div class="row mb-4 justify-content-center">
        <div class="col-md-12">
            <div class="mb-4">
                <h4>Social Accounts</h4>
            </div>
            <div class="result">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
            <div class="table-responsive mb-4">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Social Media</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user_socials as $user_social)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user_social->social_media }}</td>
                                <td><a href="{{ $user_social->link }}" target="__blank">{{ $user_social->link }}</a></td>
                                <td><a href="{{ route('super.approve', $user_social->id) }}" class="btn btn-primary" onclick="return confirm('are you sure you want to approve this profile link?')">Approve</a> <a href="{{ route('super.decline', $user_social->id) }}" class="btn btn-danger" onclick="return confirm('are you sure you want to decline this profile link?')">Decline</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
