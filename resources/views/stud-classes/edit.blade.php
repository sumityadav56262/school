@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header bg-success">Edit Class</div>

        <form method="POST" action="{{ route('stud-classes.update', $studClass->id) }}">
            @csrf
            @method('PUT')

            @include('stud-classes.form') {{-- Form partial for class_name field --}}

            <div class="h-line"></div>

            <div class="add-fees-footer">
                <button type="submit" class="btn btn-primary">✓</button>
            </div>
        </form>
    </div>
@endsection
