@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Add Teacher</div>
    <form method="POST" action="{{ route('teachers.store') }}">
        @csrf
        @include('teachers.form')
        <div class="add-fees-footer">
            <button type="submit">+</button>
        </div>
    </form>
</div>
@endsection
