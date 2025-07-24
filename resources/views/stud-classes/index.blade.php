@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Student Classes</h1>
        <p class="text-muted mb-0">Manage and organize student classes and grades.</p>
    </div>

    <div class="add-fees-section">
        <div class="add-fees-header">
            <i class="fas fa-school me-2"></i>Class Management
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2">
                <a href="{{ route('stud-classes.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add Class
                </a>
                <a href="{{ route('stud-classes.show', 'trash') }}" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Trash
                </a>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-list me-1"></i>{{ count($classes) }} classes total</small>
            </div>
        </div>

        <table class="table table-hover student_classes_datatable">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-1"></i>S. No.</th>
                    <th><i class="fas fa-graduation-cap me-1"></i>Class Name</th>
                    <th class="no-sort"><i class="fas fa-cogs me-1"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $index => $class)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $index + 1 }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $class->class_name }}</div>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('stud-classes.edit', $class->id) }}" class="btn btn-sm btn-primary" title="Edit Class">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('stud-classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Move to Trash"
                                        onclick="return confirm('Are you sure you want to move this class to trash?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
