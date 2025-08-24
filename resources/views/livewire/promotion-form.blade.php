<div class="row g-3">

    {{-- Grade --}}
    <div class="col-md-4">
        <label for="to_grade" class="form-label fw-semibold text-primary small d-block">
            <i class="bi bi-mortarboard-fill me-1"></i> Grade
        </label>
        <select wire:model="selectedGrade" name="{{ $gradeName }}" id="to_grade"
            class="form-select rounded-3 w-100 h-75">
            <option value="">Choose Grade...</option>
            @foreach($grades as $grade)
            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
        <div>
            @error( $gradeName )
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Classroom --}}
    <div class="col-md-4">
        <label for="to_classroom" class="form-label fw-semibold text-success small d-block">
            <i class="bi bi-building me-1"></i> Classroom
        </label>
        <select wire:model="selectedClassroom" name="{{ $classroomName }}" id="to_classroom"
            class="form-select rounded-3 w-100 h-75"
            @if(empty($classrooms)) disabled @endif>
            <option value="">Choose Classroom...</option>
            @foreach($classrooms as $classroom)
            <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        <div>
            @error( $classroomName)
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Section --}}
    <div class="col-md-4">
        <label for="to_section" class="form-label fw-semibold text-danger small d-block">
            <i class="bi bi-people-fill me-1"></i> Section
        </label>
        <select wire:model="selectedSection" name="{{ $sectionName }}" id="to_section"
            class="form-select rounded-3 w-100 h-75"
            @if(empty($sections)) disabled @endif>
            <option value="">Choose Section...</option>
            @foreach($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
        </select>
        <div>
            @error( $sectionName )
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

</div>