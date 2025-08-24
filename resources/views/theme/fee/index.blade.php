@extends('theme.master')
@section('title', __('keyworld.fees'))

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
                <h2 class="fw-bold text-primary mb-3 mb-md-0">Fee</h2>
                <div class="d-flex flex-wrap">

                    {{-- Add fee --}}
                    <a href="{{ route('theme.fee.create') }}" class="btn btn-success shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Add Fee
                    </a>
                </div>
            </div>

            {{-- Fee Table --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle mb-0 text-center">
                            <thead class="table-primary align-middle">
                                <tr>
                                    <th class=" text-dark" style="width: 5%;">#</th>
                                    <th class=" text-dark" style="width: 20%;">Grade</th>
                                    <th class=" text-dark" style="width: 25%;">Class</th>
                                    <th class=" text-dark" style="width: 15%;">Section</th>
                                    <th class=" text-dark" style="width: 15%;">Academic year</th>
                                    <th class=" text-dark" style="width: 15%;"> amount</th>
                                    <th class=" text-dark" style="width: 15%;"> Fee Type</th>
                                    <th class=" text-dark" style="width: 20%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fees as $index => $fee)
                                <tr>
                                    <td class="fw-bold">{{ $index + 1 }}</td>
                                    <td class="text-capitalize">{{ $fee->grade->name }}</td>
                                    <td class="text-break">{{ $fee->classe->name }}</td>
                                    <td>{{ $fee->section->name ?? '-' }}</td>
                                    <td>{{ $fee->academic_year ?? '-' }}</td>
                                    <td>{{ $fee->amount ?? '-' }}</td>
                                    <td>{{ $fee->fee_type ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('theme.fee.edit', $fee->id) }}"
                                                class="btn btn-warning btn-sm shadow-sm">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>

                                            <form action="{{ route('theme.fee.destroy', $fee->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm shadow-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted py-4">🚫 No fees found</td>
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