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
                    <h5 class="mb-0">{{ __('keyworld.add_sections') }}</h5>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('theme.sections.store') }}" method="POST">
                        @csrf

                        {{-- اسم الفصل --}}
                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-sections')}} (English) </label>
                            <input type="text" name="name_en" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter class name" value="{{ old('name_en') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('keyworld.name-sections') }} (عربي) </label>
                            <input type="text" name="name_ar" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter class name" value="{{ old('name_ar') }}">
                            @error('name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                                placeholder="Enter status" value="{{ old('status') }}">
                            @error('status')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        @livewire('add-section')
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