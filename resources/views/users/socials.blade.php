@extends('layouts.users')
@section('title', 'Social Accounts')
@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf
                @foreach ($socials as $social)
                    @php
                        $user_social = $user->user_socials->where('social_media', $social)->first();
                        if ($user_social?->status == 'pending')
                        {
                            $color = 'warning';
                        }
                        elseif($user_social?->status == 'approved')
                        {
                            $color = 'success';
                        }
                        else 
                        {
                            $color = 'danger';
                        }
                    @endphp
                    <div class="mb-4">
                        <label for="{{ $social }}">{{ ucfirst($social) }} Link</label>
                        <input type="hidden" name="social_medias[]" value="{{ $social }}">
                        <input type="text" name="links[]" id="{{ $social }}" class="form-control" placeholder="Enter your {{ $social }} profile link"  value="{{ $user_social?->link }}">
                        <span class="text-{{ $color }} text-sm text-small">{{ $user_social?->status }}</span>
                    </div>
                @endforeach
                <div class="mb-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary w-100">Save Info</button>
                </div>
            </form>
        </div>
    </div>
@endsection