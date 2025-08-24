<div>
    <div class="form-group">
        <label for="grade">{{ __('keyworld.grades') }}:</label>
        <select wire:model="selectedGrade" class="form-control">
            <option value=""> {{__('keyworld.Select your grades')}}</option>
            @foreach($grades as $grade)
            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
    </div>

    @if(!empty($classes))
    <div class="form-group mt-3">
        <label for="class">{{ __('keyworld.Classes') }}:</label>
        <select wire:model="selectedClass" class="form-control">
            <option value="">{{__('keyworld.Select your class')}}</option>
            @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if($selectedClass)
    <div class="mt-3">
        <button wire:click="submit" class="btn btn-primary">{{__('keyworld.sections')}}</button>
    </div>
    @endif

    @if(!empty($sections))
    <div class="mt-4">
        <h5>Sections:</h5>
        <ul class="list-group">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="table-secondary text-dark">#</th>
                        <th class="table-secondary text-dark">{{ __('keyworld.sections') }} (AR)</th>
                        <th class="table-secondary text-dark">{{ __('keyworld.sections') }} (EN)</th>
                        <th class="table-secondary text-dark">{{ __('keyworld.status') }}</th>
                        <th class="table-secondary text-dark">{{__('keyworld.operation')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sections as $index => $section)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $section->getTranslation('name', 'ar') }}</td>
                        <td>{{ $section->getTranslation('name', 'en') }}</td>
                        <td>
                            <span class="badge px-3 py-2 fw-semibold {{ $section->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                {{ $section->status == 1 ? 'Active' : 'Not Active' }}
                            </span>
                        </td>

                        <td>

                            <a href="{{ route('theme.sections.edit', $section->id) }}" class="btn btn-sm btn-warning">
                                {{ __('keyworld.edit') }}
                            </a>

                            <!-- زر الحذف -->
                            <form action="{{ route('theme.sections.destroy', $section->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">{{__('keyworld.delete')}}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </ul>
    </div>
    @endif
</div>