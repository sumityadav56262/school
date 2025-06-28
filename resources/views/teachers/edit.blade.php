@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Edit Teacher</div>
    <form method="POST" action="{{ route('teachers.update', $teacher) }}">
        @csrf
        @method('PUT')
        @include('teachers.form')
        <div class="add-fees-footer">
            <button type="submit">✓</button>
        </div>
    </form>
</div>
@endsection
