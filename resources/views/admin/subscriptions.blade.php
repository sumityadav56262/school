@extends('subscription.layouts')

@section('title', 'Manage Subscriptions')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">User Subscriptions</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Ends On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $sub)
            <tr>
                <td>{{ $sub->user->name }}</td>
                <td>{{ $sub->plan_name }}</td>
                <td>
                    @if($sub->status === 'active')
                        <span class="badge bg-success">Active</span>
                    @elseif($sub->status === 'cancelled')
                        <span class="badge bg-danger">Cancelled</span>
                    @else
                        <span class="badge bg-warning">Pending</span>
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($sub->end_date)->format('d M Y') }}</td>
                <td>
                    <form action="{{ route('admin.subscriptions.extend', $sub->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <input type="number" name="months" class="form-control form-control-sm d-inline w-25" min="1" placeholder="Months">
                        <button type="submit" class="btn btn-sm btn-primary">Extend</button>
                    </form>

                    <form action="{{ route('admin.subscriptions.cancel', $sub->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
