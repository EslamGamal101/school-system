@props(['messages'])

@if ($messages)
<div {{ $attributes->merge(['class' => 'text-sm text-danger mt-1']) }}>
    @foreach ((array) $messages as $message)
    <div class="alert alert-danger p-1 py-2 mb-1" role="alert" style="text-align: start;">
        {{ $message }}
    </div>
    @endforeach
</div>
@endif