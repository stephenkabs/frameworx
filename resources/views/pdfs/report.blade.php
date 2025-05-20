<!DOCTYPE html>
<html>
<head>
    <title>{{ $report->title }} - PDF Export</title>
</head>
<body>
    {{-- <h1 style="font-size: 25px" >{{ $report->title }}</h1><hr>
    <p style="font-size: 11px">{{ $report->name }}</p> --}}

    <div class="card">
        <div class="card-body">


            <h4 class="card-title"><a class="btn btn-info waves-effect waves-light" href="/report"><i class="dripicons-arrow-thin-left"></i></a>
                <a class="btn btn-info waves-effect waves-light" href="{{ route('report.edit',$report->slug) }}"><i class="dripicons-document-edit"></i></a><br><br>


            <h4 class="card-title"> {{ $report->name }}'s information<br> <span style="font-size: 13px; color:rgb(158, 158, 158);" > Report By: {{ $report->member->name }} |
            {{ $report->department->name }}
            </span></h4>

            <p>    {{$report->about }}<br><br>
                {{-- <h4 class="card-title"> <a class="btn btn-info waves-effect waves-light" href="/reports/{{ $report->image }}" download>Download Attachment</a></h4><hr><br> --}}

            </p>


        </div>
    </div>
</body>
</html>
