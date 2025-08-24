@extends('theme.master')
@section('title', __('keyworld.student_promotion'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-5">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h3 class="mb-0">🎓 Promote Student</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('theme.store_promotion') }}">
                        @csrf

                        {{-- Student Info --}}
                        <h5 class="text-secondary mb-3">Current Information</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="student_name" class="form-label fw-bold">Student Name</label>
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="text" class="form-control" value="{{ $student->name }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="current_grade" class="form-label fw-bold">Grade</label>
                                <input type="hidden" name="from_grade" value="{{ $student->grade_id }}">
                                <input type="text" class="form-control" id="current_grade" value="{{ $student->grade->name ?? old('current_grade') }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="current_classroom" class="form-label fw-bold">Classroom</label>
                                <input type="hidden" name="from_classroom" value="{{ $student->classroom_id }}">
                                <input type="text" class="form-control" id="current_classroom" value="{{ $student->classroom->name ?? old('current_classroom') }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="current_section" class="form-label fw-bold">Section</label>
                                <input type="hidden" name="from_section" value="{{ $student->section_id }}">
                                <input type="text" class="form-control" id="current_section" value="{{ $student->section->name ?? old('current_section') }}" readonly>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="from_academic_year" class="form-label fw-bold">From Academic Year</label>
                                <input type="text" name="from_academic_year" class="form-control" id="from_academic_year">
                            </div>
                            <div class="col-md-6">
                                <label for="to_academic_year" class="form-label fw-bold">To Academic Year</label>
                                <input type="text" name="to_academic_year" class="form-control" id="to_academic_year">
                            </div>
                        </div>

                </div>

                <hr>

                {{-- Promotion Info --}}
                <h5 class="text-primary mb-3">Promotion To</h5>
                @livewire('promotion-form', [
                'gradeName' => 'to_grade',
                'classroomName' => 'to_classroom',
                'sectionName' => 'to_section',
                ])

                {{-- Submit --}}
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        🚀 Promote
                    </button>
                </div>

                </form>
            </div>
        </div>

</div>
</main>
</div>
@endsection