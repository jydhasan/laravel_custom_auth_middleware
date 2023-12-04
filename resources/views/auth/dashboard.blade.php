@extends('layouts.app')
@section('title', 'First Dashboard')
@section('content')
    <div class="container mt-4 shadow-lg p-3 mb-5 bg-body-tertiary rounded" style="max-width: 400px;margin:0px auto;">
        <h1>Dashboard</h1>
        <h2>Welcome {{ $LoggedUserInfo['name'] }}</h2>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
@endsection