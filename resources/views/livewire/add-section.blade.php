<div>
    <div class="form-group">
        <label for="grade">{{ __('keyworld.grades') }}:</label>
        <select wire:model="selectedGrade" class="form-control">
            <option value="">{{ __('keyworld.Select your grades') }}</option>
            @foreach($grades as $grade)
            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
    </div>

    @if(!empty($classes))
    <div class="form-group mt-3">
        <label for="class">{{ __('keyworld.Classes') }}:</label>
        <select wire:model="selectedClass" class="form-control">
            <option value="">{{ __('keyworld.Select your class') }}</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    {{-- hidden inputs لربط Livewire بالـ Form --}}
    <input type="hidden" name="grade_id" value="{{ $selectedGrade }}">
    <input type="hidden" name="classes_id" value="{{ $selectedClass }}">
</div>