@extends('theme.master')
@section('title','Edit Grade')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <form action="{{ route('theme.Grade.update', $grade->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="container">
                <div class="row">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- English Name --}}
                    <div class="col-6">
                        <label class="form-label">{{ __('keyworld.namegrade') }} (English)</label>
                        <input type="text" name="name_en" class="form-control" placeholder="Enter grade name"
                            value="{{ old('name_en', $grade->getTranslation('name', 'en')) }}">
                        @error('name_en')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Arabic Name --}}
                    <div class="col-6">
                        <label class="form-label">{{ __('keyworld.namegrade') }} (عربي)</label>
                        <input type="text" name="name_ar" class="form-control" placeholder="ادخل اسم المرحله الدراسيه"
                            value="{{ old('name_ar', $grade->getTranslation('name', 'ar')) }}">
                        @error('name_ar')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="col-12 mt-4">
                        <label class="form-label">{{ __('keyworld.notes') }}</label>
                        <textarea name="notes" class="form-control" rows="4">{{ old('notes', $grade->notes) }}</textarea>
                        @error('notes')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div class="col-12 mt-4 d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-start' : 'justify-content-end' }}">
                        <button type="submit" class="btn btn-primary btn-lg w-50">
                            {{ __('keyworld.update') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</div>
@endsection