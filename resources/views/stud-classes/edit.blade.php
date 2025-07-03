@extends('layout')

@section('content')
<div class="add-fees-section">
    <div class="add-fees-header">Edit Class</div>

    <form method="POST" action="{{ route('stud-classes.update', $classes->id) }}">
        @csrf
        @method('PUT')

        @include('student_class.form') {{-- Form partial for class_name field --}}

        <div class="h-line"></div>

        <div class="add-fees-footer">
            <button type="submit" class="btn btn-primary">✓</button>
        </div>
    </form>
</div>
@endse
