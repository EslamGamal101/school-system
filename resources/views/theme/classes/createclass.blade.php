@extends('theme.master')
@section('title', __('keyworld.add_class'))

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
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('keyworld.add_grade') }}</h5>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('theme.classes.store') }}" method="POST">
                        @csrf

                        {{-- اسم الفصل --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-class')}} (English) </label>
                            <input type="text" name="name_en" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter class name" value="{{ old('name_en') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-class') }} (عربي) </label>
                            <input type="text" name="name_ar" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter class name" value="{{ old('name_ar') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- المرحلة الدراسية المرتبطة --}}
                        <div class="mb-4">
                            <label class="form-label fs-5 fw-bold text-dark" style="font-size: 1rem; padding: 1rem; height: auto;">
                                {{ __('keyworld.namegrade') }}
                            </label>
                            <select name="grade_id"
                                class="form-select border-primary shadow-sm @error('grade_id') is-invalid @enderror"
                                style="font-size: 1rem; padding: 1rem; height: auto;">
                                <option value="">{{ __('keyworld.namegrade') }}</option>
                                @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('grade_id')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>



                        {{-- زرار الإرسال --}}
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                {{ __('keyworld.submit') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection