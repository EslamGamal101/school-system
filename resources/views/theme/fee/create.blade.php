@extends('theme.master')
@section('title', __('keyworld.student_promotion'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-5">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="mb-0"> ADD FEE</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('theme.fee.store') }}">
                        @csrf


                        <h5 class="text-secondary mb-3">Current Information</h5>
                        @livewire('promotion-form', [
                        'gradeName' => 'grade_id',
                        'classroomName' => 'classe_id',
                        'sectionName' => 'section_id',
                        ])
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="academic_year" class="form-label fw-bold"> Academic Year</label>
                        <input type="text" name="academic_year" class="form-control" id="academic_year">
                        <div>
                            @error('academic_year')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="amount" class="form-label fw-bold">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount">
                        <div>
                            @error('amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="fee_type" class="form-label fw-bold">Fee Type</label>
                        <input type="text" name="fee_type" class="form-control" id="fee_type">
                        <div>
                            @error('fee_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
                </div>
            </div>


            <hr>
            {{-- Submit --}}
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success btn-lg px-5">
                    🚀 Promote
                </button>
            </div>

            </form>
        </div>

    </main>
</div>
@endsection