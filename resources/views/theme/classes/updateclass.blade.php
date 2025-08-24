@extends('theme.master')
@section('title','Edit Class')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <form action="{{ route('theme.classes.update', $class->id) }}" method="POST">
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
                        <input type="text" name="name_en" class="form-control" placeholder="Enter class name"
                            value="{{ old('name_en', $class->getTranslation('name', 'en')) }}">
                        @error('name_en')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Arabic Name --}}
                    <div class="col-6">
                        <label class="form-label">{{ __('keyworld.namegrade') }} (عربي)</label>
                        <input type="text" name="name_ar" class="form-control" placeholder="ادخل اسم الصف"
                            value="{{ old('name_ar', $class->getTranslation('name', 'ar')) }}">
                        @error('name_ar')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Select Grade --}}
                    <div class="col-12 mt-4">
                        <label class="form-label">{{ __('keyworld.Academic stages') }}</label>
                        <select name="grade_id" class="form-select @error('grade_id') is-invalid @enderror">
                            <option value="">{{ __('keyworld.Select your class') }}</option>
                            @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $class->grade_id) == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('grade_id')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
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