@extends('theme.master')
@section('title', __('keyworld.edit_teacher'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-4">

            <div class="container my-5">
                <h2 class="mb-4 text-primary">Edit Teacher</h2>
                <form method="POST" action="{{ route('theme.teacher.update', $teacher->id) }}">
                    @csrf
                    @method('PUT') {{-- مهم عشان التعديل --}}

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="Email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control @error('Email') is-invalid @enderror"
                            id="Email" name="Email" value="{{ old('Email', $teacher->Email) }}" required>
                        @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Joining Date --}}
                    <div class="mb-3">
                        <label for="Joining_Date" class="form-label fw-bold">Joining Date</label>
                        <input type="date" class="form-control @error('Joining_Date') is-invalid @enderror"
                            id="Joining_Date" name="Joining_Date"
                            value="{{ old('Joining_Date', $teacher->Joining_Date) }}" required>
                        @error('Joining_Date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="Address" class="form-label fw-bold">Address</label>
                        <textarea class="form-control @error('Address') is-invalid @enderror"
                            id="Address" name="Address" rows="3" required>{{ old('Address', $teacher->Address) }}</textarea>
                        @error('Address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-primary">Gender</label>
                        <select class="form-select form-select-lg @error('Gender') is-invalid @enderror"
                            name="Gender" required>
                            <option value="" disabled>Choose gender...</option>
                            <option value="male" {{ old('Gender', $teacher->Gender) == 'male' ? 'selected' : '' }}>♂️ Male</option>
                            <option value="female" {{ old('Gender', $teacher->Gender) == 'female' ? 'selected' : '' }}>♀️ Female</option>
                        </select>
                        @error('Gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Specialist --}}
                    <div class="mb-5">
                        <label class="form-label fw-bold text-primary">Specialist</label>
                        <select class="form-select form-select-lg @error('specialist_id') is-invalid @enderror"
                            name="specialist_id" required>
                            <option value="" disabled>Choose specialist...</option>
                            @foreach($specialists as $specialist)
                            <option value="{{ $specialist->id }}" {{ old('specialist_id', $teacher->specialist_id) == $specialist->id ? 'selected' : '' }}>
                                {{ is_array($specialist->name) ? $specialist->name['en'] : $specialist->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('specialist_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary px-5">Update Teacher</button>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection