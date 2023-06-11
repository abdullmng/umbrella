@extends('layouts.users')
@section('title', 'Bank Info')
@section('content')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf
                <div class="mb-4">
                    <label for="account_name">Account Name</label>
                    <input type="text" name="account_name" id="account_name" class="form-control" value="{{ $user->account_name }}">
                    @if ($errors->has('account_name'))
                        <span class="text-danger text-small text-sm">{{ $errors->first('account_name') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="account_number">Account Number</label>
                    <input type="text" name="account_number" id="account_number" class="form-control" value="{{ $user->account_number }}">
                    @if ($errors->has('account_number'))
                        <span class="text-danger text-small text-sm">{{ $errors->first('account_number') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="bank">Bank</label>
                    <select name="bank" id="bank" class="form-control">
                        <option value="">select bank</option>
                        @foreach ($banks as $bank)
                            <option value="{{ $bank['code']."-".$bank['name'] }}" {{ $user->bank == $bank['code']."-".$bank['name'] ? 'selected': '' }}>{{ $bank['name'] }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('bank'))
                        <span class="text-danger text-small text-sm">{{ $errors->first('bank') }}</span>
                    @endif
                </div>
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