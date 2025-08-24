@extends('theme.master')
@section('content')

<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container my-5">
            <h2 class="mb-4 text-primary">Edit Student</h2>
            <form method="POST" action="{{ route('theme.student.update', $student->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Student Name --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-success">Student Name</label>
                        <input type="text" name="name" class="form-control border-success"
                            value="{{ old('name', $student->name) }}" required>
                        @error('name')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- National ID --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-success">National ID</label>
                        <input type="number" name="national_id" class="form-control border-success"
                            value="{{ old('national_id', $student->national_id) }}" required>
                        @error('national_id')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Email</label>
                        <input type="email" name="email" class="form-control border-primary"
                            value="{{ old('email', $student->email) }}" required>
                        @error('email')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-primary">Password (Leave blank if unchanged)</label>
                        <input type="password" name="password" class="form-control border-primary">
                        @error('password')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div class="col-md-6">
                        <label class="fw-bold text-info">Birth Date</label>
                        <input type="date" name="birth_date" class="form-control border-info"
                            value="{{ old('birth_date', $student->birth_date) }}" required>
                        @error('birth_date')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Religion --}}
                    <div class="form-group col-6">
                        <label class="font-weight-bold text-info">Religion</label>
                        <select name="religion_id" class="custom-select border-info">
                            <option disabled>{{ __('keyworld.Choose') }}...</option>
                            @foreach($Religions as $Religion)
                            <option value="{{ $Religion->id }}"
                                {{ $Religion->id == old('religion_id', $student->religion_id) ? 'selected' : '' }}>
                                {{ $Religion->name_ar }}
                            </option>
                            @endforeach
                        </select>
                        @error('religion_id')
                        <div class="alert alert-danger mt-1 p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Grade, Classroom, Section --}}
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label class="font-weight-bold text-warning">Grade</label>
                            <select class="custom-select border-warning" name="grade_id" id="grade_id" required>
                                <option disabled>Select Grade...</option>
                                @foreach($grades as $grade)
                                <option value="{{ $grade->id }}"
                                    {{ $grade->id == old('grade_id', $student->grade_id) ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label class="font-weight-bold text-warning">Classroom</label>
                            <select class="custom-select border-warning" name="classroom_id" id="classroom_id" required>
                                <option disabled>Select Classroom...</option>
                                @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    {{ $classroom->id == old('classroom_id', $student->classroom_id) ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label class="font-weight-bold text-warning">Section</label>
                            <select class="custom-select border-warning" name="section_id" id="section_id" required>
                                <option disabled>Select Section...</option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ $section->id == old('section_id', $student->section_id) ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Parent --}}
                    <div class="form-group col-6">
                        <label class="font-weight-bold text-success">Parent</label>
                        <select class="custom-select border-success" name="parent_id" required>
                            <option disabled>Select Parent...</option>
                            @foreach($parents as $parent)
                            <option value="{{ $parent->id }}"
                                {{ $parent->id == old('parent_id', $student->parent_id) ? 'selected' : '' }}>
                                {{ $parent->Name_Father }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Address --}}
                    <div class="col-12">
                        <label class="fw-bold text-secondary">Address</label>
                        <textarea name="address" class="form-control border-secondary" rows="3" required>{{ old('address', $student->address) }}</textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-warning px-5 mt-4">Update Student</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- Ajax Script (Grades -> Classrooms -> Sections) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#grade_id').on('change', function() {
        let gradeId = $(this).val();
        $('#classroom_id').empty().append('<option disabled selected>Loading...</option>');
        $('#section_id').empty().append('<option disabled selected>Select Section...</option>');

        $.get(`/get-classrooms/${gradeId}`, function(data) {
            $('#classroom_id').empty().append('<option disabled selected>Select Classroom...</option>');
            data.forEach(classroom => {
                $('#classroom_id').append(`<option value="${classroom.id}">${classroom.name}</option>`);
            });
        });
    });

    $('#classroom_id').on('change', function() {
        let classroomId = $(this).val();
        $('#section_id').empty().append('<option disabled selected>Loading...</option>');

        $.get(`/get-sections/${classroomId}`, function(data) {
            $('#section_id').empty().append('<option disabled selected>Select Section...</option>');
            data.forEach(section => {
                $('#section_id').append(`<option value="${section.id}">${section.name}</option>`);
            });
        });
    });
</script>
@endsection