@extends('theme.master')
@section('title','Grades & Classes')
@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container my-4">
            <h2 class="mb-4 text-primary text-center">Teachers List</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="mb-3 text-end">
                <a href="{{ route('theme.teacher.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add New Teacher
                </a>
            </div>

            <table class="table table-striped table-hover table-bordered shadow-sm">
                <thead class="table-primary text-dark">
                    <tr>
                        <th class=" text-dark">#</th>
                        <th class=" text-dark">Name</th>
                        <th class=" text-dark">Email</th>
                        <th class=" text-dark">Joining Date</th>
                        <th class=" text-dark">Gender</th>
                        <th class=" text-dark">Specialist</th>
                        <th class=" text-dark">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $index => $teacher)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->Email }}</td>
                        <td>{{ \Carbon\Carbon::parse($teacher->Joining_Date)->format('d/m/Y') }}</td>
                        <td class="text-capitalize">{{ $teacher->Gender }}</td>
                        <td>
                            {{ is_array($teacher->specialist->name) 
    ? $teacher->specialist->name['en'] 
    : $teacher->specialist->name }}
                        </td>
                        <td>
                            <a href="{{ route('theme.teacher.edit', $teacher->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('theme.teacher.destroy', $teacher->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this teacher?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No teachers found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection