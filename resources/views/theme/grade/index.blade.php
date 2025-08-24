@extends('theme.master')
@section('title','Grade')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-dark">#</th>
                    <th class="text-dark">{{ __('keyworld.name-stage') }} </th>
                    <th class="text-dark">{{ __('keyworld.notes') }}</th>
                    <th class="text-dark">{{ __('keyworld.operation') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $index => $grade)
                <tr>
                    <th scope=" row">{{ $index + 1 }}</th>
                    <td>{{ $grade->name }}</td>
                    <td>{{ $grade->notes ?? '-' }}</td>
                    <td>
                        <a href="{{ route('theme.Grade.edit', $grade->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('theme.Grade.destroy', $grade->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No grades found</td>
                </tr>
                @endforelse
            </tbody>
        </table>


        <div class="d-flex mt-3 {{ app()->getLocale() == 'ar' ? 'justify-content-start' : 'justify-content-end' }}">
            <a href="{{ route('theme.Grade.create') }}" class="btn btn-primary">
                {{ __('keyworld.add_grade') }}
            </a>
        </div>

    </main>
</div>
@endsection