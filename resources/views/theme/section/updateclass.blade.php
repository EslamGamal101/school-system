@extends('theme.master')
@section('title', __('keyworld.edit_section'))

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="container mt-4">

            {{-- success message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">{{ __('keyworld.edit_section') }}</h5>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('theme.sections.update', $section->id) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-sections') }} (English)</label>
                            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                                value="{{ old('name_en', $section->getTranslation('name', 'en')) }}">
                            @error('name_en')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-sections') }} (عربي)</label>
                            <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                                value="{{ old('name_ar', $section->getTranslation('name', 'ar')) }}">
                            @error('name_ar')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">
                                <i class="bi bi-toggle-on me-1"></i> {{ __('keyworld.status') }}
                            </label>
                            <div class="input-group">
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option disabled selected>-- Select Status --</option>
                                    <option value="1" {{ old('status', $section->status) == 1 ? 'selected' : '' }}>🟢 Active</option>
                                    <option value="0" {{ old('status', $section->status) == 0 ? 'selected' : '' }}>🔴 Not Active</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        @livewire('add-section', ['selectedGrade' => $section->grade_id, 'selectedClass' => $section->class_id])
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-warning">
                                {{ __('keyworld.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection