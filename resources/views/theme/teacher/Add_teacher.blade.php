@extends('theme.master')
@section('title', __('keyworld.add_class'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-4">

            <div class="container my-5">
                <h2 class="mb-4 text-primary">Add New Teacher</h2>
                <form method="POST" action="{{ route('theme.teacher.store') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="Email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" value="{{ old('Email') }}" required>
                        @error('Email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="Password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control @error('Password') is-invalid @enderror" id="Password" name="Password" required>
                        @error('Password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Joining Date --}}
                    <div class="mb-3">
                        <label for="Joining_Date" class="form-label fw-bold">Joining Date</label>
                        <input type="date" class="form-control @error('Joining_Date') is-invalid @enderror" id="Joining_Date" name="Joining_Date" value="{{ old('Joining_Date') }}" required>
                        @error('Joining_Date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="Address" class="form-label fw-bold">Address</label>
                        <textarea class="form-control @error('Address') is-invalid @enderror" id="Address" name="Address" rows="3" required>{{ old('Address') }}</textarea>
                        @error('Address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold text-primary">Gender</label>
                        <select class="form-select form-select-lg @error('Gender') is-invalid @enderror" name="Gender" required>
                            <option value="" disabled {{ old('Gender') ? '' : 'selected' }}>Choose gender...</option>
                            <option value="male" {{ old('Gender') == 'male' ? 'selected' : '' }}>♂️ Male</option>
                            <option value="female" {{ old('Gender') == 'female' ? 'selected' : '' }}>♀️ Female</option>
                        </select>
                        @error('Gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Specialist --}}
                    <div class="mb-5">
                        <label class="form-label fw-bold text-primary">Specialist</label>
                        <select class="form-select form-select-lg @error('Specialists_id') is-invalid @enderror" name="Specialists_id" required>
                            <option value="" disabled {{ old('Specialists_id') ? '' : 'selected' }}>Choose specialist...</option>
                            @foreach($specialists as $specialist)
                            <option value="{{ $specialist->id }}" {{ old('Specialists_id') == $specialist->id ? 'selected' : '' }}>
                               {{ $specialist->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('Specialists_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary px-5">Add Teacher</button>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection