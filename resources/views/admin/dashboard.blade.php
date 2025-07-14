@extends('subscription.layouts')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4>Total Registered Users</h4>
                    <p class="display-6">{{ $userCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h4>Active Subscriptions</h4>
                    <p class="display-6">{{ $activeSubs }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
