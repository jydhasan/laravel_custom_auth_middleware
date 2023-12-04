@extends('layouts.app')
@section('title', 'Laravel 8 Basics')
@section('content')
    <div class="container mt-4 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="max-width: 400px;margin:0px auto;">
        {{-- show seccess message --}}
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            {{-- else error message --}}
        @elseif (Session::has('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <form action="{{ route('login-user') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    value="{{ old('email') }}">
                {{-- error message --}}
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                {{-- error message --}}
                <span class="text-danger">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
