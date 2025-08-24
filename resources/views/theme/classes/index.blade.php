@extends('theme.master')
@section('title','Grades & Classes')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="container">
            {{-- Loop through Grades --}}
            @forelse($grades as $grade)
            <div class="card my-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        {{ $grade->getTranslation('name', app()->getLocale()) }}
                    </h5>
                    <div>
                        <a href="{{ route('theme.Grade.edit', $grade->id) }}" class="btn btn-sm btn-light me-2">
                            ✏️ {{ __('keyworld.edit') }}
                        </a>
                        <form action="{{ route('theme.Grade.destroy', $grade->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                🗑 {{ __('keyworld.delete') }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body bg-light">
                    @if($grade->classes->isEmpty())
                    <p class="text-muted mb-0">{{ __('No data') }}</p>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover bg-white text-dark mb-0">
                            <thead class="table-secondary">
                                <tr>
                                    <th class="text-dark">#</th>
                                    <th class="text-dark">{{ __('keyworld.name-class') }}</th>
                                    <th class="text-dark">{{ __('keyworld.operation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($grade->classes as $index => $class)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ is_array($class->name) ? $class->getTranslation('name', app()->getLocale()) : $class->name }}</td>
                                    <td>
                                        <a href="{{ route('theme.classes.edit', $class->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                                        <form action="{{ route('theme.classes.destroy', $class->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="alert alert-info text-center">No data </div>
            @endforelse

            {{-- Add Button --}}
            <div class="d-flex mt-4 {{ app()->getLocale() == 'ar' ? 'justify-content-start' : 'justify-content-end' }}">
                <a href="{{ route('theme.classes.create') }}" class="btn btn-success">
                    ➕ {{ __('keyworld.add_class') }}
                </a>
            </div>
        </div>

    </main>
</div>
@endsection