@extends('layout')

@section('content')
    <div class="add-fees-section">
        <div class="add-fees-header">Add Class</div>

        <form method="POST" action="{{ route('stud-classes.store') }}">
            @csrf

            @include('stud-classes.form') {{-- Contains the input for class_name --}}

            <div class="h-line"></div>

            <div class="add-fees-footer">
                <button type="submit" class="btn btn-success">+</button>
            </div>
        </form>
    </div>
@endsection
