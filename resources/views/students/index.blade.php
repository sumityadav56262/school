@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Manage Students</h1>
        <p class="text-muted mb-0">View and manage all enrolled students in the system.</p>
    </div>

    <div class="add-fees-section">
        <div class="add-fees-header">
            <i class="fas fa-user-graduate me-2"></i>Students Directory
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2">
                <a href="{{ route('students.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add Student
                </a>
                <a href="{{ route('students.show', 'trash') }}" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Trash
                </a>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-users me-1"></i>{{ count($students) }} students total</small>
            </div>
        </div>

        <table class="table table-hover student_datatable">
            <thead>
                <tr>
                    <th><i class="fas fa-id-card me-1"></i>EMIS</th>
                    <th><i class="fas fa-user me-1"></i>Name</th>
                    <th><i class="fas fa-school me-1"></i>Class</th>
                    <th><i class="fas fa-hashtag me-1"></i>Roll No</th>
                    <th><i class="fas fa-male me-1"></i>Father</th>
                    <th><i class="fas fa-phone me-1"></i>Phone</th>
                    <th><i class="fas fa-map-marker-alt me-1"></i>Address</th>
                    <th class="no-sort"><i class="fas fa-cogs me-1"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>
                            <span class="badge bg-secondary">{{ $student->emis_no }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $student->stud_name }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info text-white">{{ $student->class->class_name ?? 'N/A' }}</span>
                        </td>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>
                            <a href="tel:{{ $student->mobile_no }}" class="text-decoration-none">
                                {{ $student->mobile_no }}
                            </a>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($student->address, 30) }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-primary" title="Edit Student">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Move to Trash"
                                        onclick="return confirm('Are you sure you want to move this student to trash?')">
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
