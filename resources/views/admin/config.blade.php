@extends('layouts.admin')
@section('title', 'Config')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Site Config</h4>

                    <div class="mb-4">
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <form action="" method="post">
                                @csrf
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Value</th>
                                            <th>Set</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($configs as $config)
                                            <input type="hidden" name="names[]" value="{{ $config->name }}">
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $config->title }}</td>
                                                <td>{{ $config->true_value }}</td>
                                                <td>
                                                    @if ($config->field_type == "select")
                                                        <select name="values[]" id="">
                                                            @foreach ($config['data'] as $data)
                                                                <option value="{{ $data['id'] }}" {{ $config->value == $data['id'] ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                                            @endforeach
                                                        </select>

                                                    @else
                                                        @php
                                                            $type = explode(':',$config->field_type)[1];
                                                        @endphp
                                                    <input type="{{ $type }}" name="values[]" value="{{ $config->value }}">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
