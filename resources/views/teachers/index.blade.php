@extends('layout')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold text-dark mb-2">Manage Teachers</h1>
        <p class="text-muted mb-0">View and manage all faculty members in the system.</p>
    </div>

    <div class="add-fees-section">
        <div class="add-fees-header">
            <i class="fas fa-chalkboard-teacher me-2"></i>Faculty Directory
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex gap-2">
                <a href="{{ route('teachers.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Add Teacher
                </a>
                <a href="{{ route('teachers.show', 'trash') }}" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Trash
                </a>
            </div>
            <div class="text-muted">
                <small><i class="fas fa-users me-1"></i>{{ count($teachers) }} teachers total</small>
            </div>
        </div>

        <table class="table table-hover teacher_datatable">
            <thead>
                <tr>
                    <th><i class="fas fa-calendar-days me-1"></i>Date</th>
                    <th><i class="fas fa-id-badge me-1"></i>ID Card</th>
                    <th><i class="fas fa-user me-1"></i>Name</th>
                    <th><i class="fas fa-briefcase me-1"></i>Designation</th>
                    <th><i class="fas fa-phone me-1"></i>Mobile</th>
                    <th><i class="fas fa-map-marker-alt me-1"></i>Address</th>
                    <th class="no-sort"><i class="fas fa-cogs me-1"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>
                            <span class="badge bg-primary">{{ $createdAt[$loop->index] }}</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">{{ $teacher->id_card_no }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $teacher->teacher_name }}</div>
                        </td>
                        <td>
                            <span class="badge bg-primary text-white">{{ $teacher->designation }}</span>
                        </td>
                        <td>
                            <a href="tel:{{ $teacher->mobile_no }}" class="text-decoration-none">
                                {{ $teacher->mobile_no }}
                            </a>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($teacher->address, 30) }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-primary"
                                    title="Edit Teacher">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Move to Trash"
                                        onclick="return confirm('Are you sure you want to move this teacher to trash?')">
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
