@extends('subscription.layouts')

@section('title', 'Manage Users')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Registered Users</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subscription Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @php
                        $latest = $user->subscriptions->sortByDesc('end_date')->first();
                    @endphp
                    @if($latest && \Carbon\Carbon::parse($latest->end_date)->isFuture())
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Expired</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
