@extends('theme.master')
@section('title','Grades & Classes')

@section('content')

<div class="wrapper">
    <main role="main" class="main-content">
        {{-- success message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3 px-4">
            <h4 class="mb-0">{{__('keyworld.sections')}}</h4>
            <a href="{{ route('theme.sections.create') }}" class="btn btn-success btn-lg px-4 py-2" style="width: 160px;">
                {{ __('keyworld.add_sections') }}
            </a>
        </div>

        @livewire('select-section')
    </main>
</div>
@endsection