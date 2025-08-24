@extends('theme.master')
@section('title','Grade')

@section('content')
<div class="wrapper">
    <main role="main" class="main-content">
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <a href="{{route('theme.online_classes.create')}}" class="btn btn-success btn-sm" role="button"
                                        aria-pressed="true">اضافة حصة جديدة</a><br><br>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                                <tr class="alert-success">
                                                    <th>#</th>
                                                    <th>المرحله الدراسيه</th>
                                                    <th>الصف الدراسي</th>
                                                    <th> الفصل</th>
                                                    <th>عنوان الحصة</th>
                                                    <th>تاريخ البداية</th>
                                                    <th>وقت الحصة</th>
                                                    <th>رابط الحصة</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($online_classes as $online_classe)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$online_classe->grade->name}}</td>
                                                    <td>{{ $online_classe->classroom->name ?? '-' }}</td>
                                                    <td>{{ $online_classe->section->name ?? '-' }}</td>
                                                    <td>{{$online_classe->topic}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($online_classe->start_time)->format('Y-m-d H:i') }}</td>
                                                    <td>{{$online_classe->duration}}</td>
                                                    <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">انضم الان</a></td>
                                    </tr>
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</main>
</div>
@endsection