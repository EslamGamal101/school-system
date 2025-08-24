@extends('theme.master')
@section('title', __('keyworld.students'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-4">

            {{-- Header with Add Button + Search --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-primary mb-3 mb-md-0">👨‍🎓 Students</h2>
                <div class="d-flex flex-wrap">
                    {{-- Search --}}
                    <form action="{{ route('theme.student.index') }}" method="GET" class="d-flex me-3 mb-2 mb-md-0">
                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control shadow-sm"
                            placeholder="🔍 Search student...">
                        <button class="btn btn-outline-primary ms-2" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>

                    {{-- Add Student --}}
                    <a href="{{ route('theme.student.create') }}" class="btn btn-success shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add Student
                    </a>
                </div>
            </div>

            {{-- Students Table --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle mb-0 text-center">
                            <thead class="table-primary align-middle">
                                <tr>
                                    <th class=" text-dark" style="width: 5%;">#</th>
                                    <th class=" text-dark" style="width: 20%;">Name</th>
                                    <th class=" text-dark" style="width: 25%;">Email</th>
                                    <th class=" text-dark" style="width: 15%;">Birth Date</th>
                                    <th class=" text-dark" style="width: 15%;">Class</th>
                                    <th class=" text-dark" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $index => $student)
                                <tr>
                                    <td class="fw-bold">{{ $index + 1 }}</td>
                                    <td class="text-capitalize">{{ $student->name }}</td>
                                    <td class="text-break">{{ $student->email }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $student->birth_date }}
                                        </span>
                                    </td>
                                    <td>{{ $student->classroom->name ?? '-' }}</td>
                                    <td>
                                        {{-- Edit --}}
                                        <a href="{{ route('theme.student.edit', $student->id) }}"
                                            class="btn btn-warning btn-sm me-2 shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>
                                        <a href="{{ route('theme.student_promrtion', $student->id) }}"
                                            class="btn btn-warning btn-sm me-2 shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i> promrtion
                                        </a>
                                        <a href="{{ route('theme.student_fee.show', $student->id) }}"
                                            class="btn btn-warning btn-sm me-2 shadow-sm">
                                            <i class="bi bi-pencil-square me-1"></i> Fee
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('theme.student.destroy', $student->id) }} " class="d-inline"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm shadow-sm"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted py-4">🚫 No students found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection