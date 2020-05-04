

@extends('layouts.app')

@section('content')
<div class="container">

@include('navbar')

  <div class="jumbotron">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h2 align="center" style="color:brown;"> Second Semester Result</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                    <div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Name:</dt> <dd style="color:brown;">{{$student->lastName }}, {{$student->otherNames}}</dd>
                    </dl> 
                    </div>

                    <div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Reg No:</dt> <dd style="color:brown;">{{$student->regNo}}</dd>
                    </dl> 
                    </div>

                    <div class="col-md-4">
                    <dl class="dl-horizontal">
                        <dt>Session:</dt> <dd style="color:brown;">2017/2018 Session</dd>
                    </dl> 
                    </div>
                   <div class="col-md-12">

            <table class="table">
                <thead>
                    <tr>
                        
                        
                        <th style="color:grey;">Course Code</th>
                        <th style="color:grey;">Course Title</th>
                        <th style="color:grey;">CA</th>
                        <th style="color:grey;">Exam</th>
                        <th style="color:grey;">Total</th>
                        <th style="color:grey;">Grade</th>
                        <th style="color:grey;">Point</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $points=0;
                    ?>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->courseCode }}</td>
                            <td>{{ $result->courseTitle }}</td>
                            <td>{{ $result->assessment }}</td>
                            <td>{{ $result->exam }}</td>
                            <td>{{ $result->total }}</td>
                            <td>{{ $result->grade }}</td>
                            <td>{{ $result->point }}</td>
                        </tr>
                        <?php $points += $result->point ?>
                    @endforeach
                    <tr>
                       <td colspan="6"> <strong>Total Points:</strong></td>
                        <td>{{$points}}</td>
                    </tr>
                </tbody>
        
                </tbody>
            </table>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
