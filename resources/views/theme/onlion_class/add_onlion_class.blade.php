@extends('theme.master')
@section('title','Grade')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="post" action="{{ route('theme.online_classes.store') }}" autocomplete="off">
                            @csrf
                           
                                @livewire('promotion-form', [
                                'gradeName' => 'grade_id',
                                'classroomName' => 'classe_id',
                                'sectionName' => 'section_id',
                                ])
                            <br>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>عنوان الحصة : <span class="text-danger">*</span></label>
                                        <input class="form-control" name="topic" type="text">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>تاريخ ووقت الحصة : <span class="text-danger">*</span></label>
                                        <input class="form-control" type="datetime-local" name="start_time">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>مدة الحصة بالدقائق : <span class="text-danger">*</span></label>
                                        <input class="form-control" name="duration" type="text">
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">__{{__('keyworld.submit')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection