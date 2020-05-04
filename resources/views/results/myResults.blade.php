
@extends('layouts.app')

@section('content')
<div class="container">

@include('navbar')

  <div class="jumbotron" style="background-image: url(img/unicalview3.jpg);">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h2 align="center" style="color:brown;"> All Results</h2></div>

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
                    </div>
<br>

                    <h4 align="center" style="color:brown;">First Semester Result</h4>
                   <div class="col-md-12">

            <table class="table">
                <thead>
                    <tr>
                        
                        
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Assessment</th>
                        <th>Exam</th>
                        <th>Total</th>
                        <th>Grade</th>
                        <th>Point</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $FirstPoints=0;
                    ?>

                    @foreach($firstSemester as $first)
                        <tr>
                           
                            <td>{{ $first->courseCode }}</td>
                            <td>{{ $first->courseTitle }}</td>
                            <td>{{ $first->assessment }}</td>
                            <td>{{ $first->exam }}</td>
                            <td>{{ $first->total }}</td>
                            <td>{{ $first->grade }}</td>
                            <td>{{ $first->point }}</td>
                        </tr>
                        <?php $FirstPoints += $first->point ?>
                    @endforeach
                    <tr>
                        <td colspan="6"> <strong>Total Points:</strong></td>
                        <td>{{$FirstPoints}}</td>
                    </tr>
                </tbody>
            </table>
    </div> 

                <h4 align="center" style="color:brown;">Second Semester Result</h4>
                        <div class="col-md-12">

            <table class="table">
                <thead>
                    <tr>
                        
                        
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Assessment</th>
                        <th>Exam</th>
                        <th>Total</th>
                        <th>Grade</th>
                        <th>Point</th>
                        
                    </tr>
                </thead>
                <tbody>
                            <?php
                                $SecondPoints=0;
                             ?>

                    @foreach($secondSemester as $second)
                        <tr>
                           
                            <td>{{ $second->courseCode }}</td>
                            <td>{{ $second->courseTitle }}</td>
                            <td>{{ $second->assessment }}</td>
                            <td>{{ $second->exam }}</td>
                            <td>{{ $second->total }}</td>
                            <td>{{ $second->grade }}</td>
                            <td>{{ $second->point }}</td>
                        </tr>
                         <?php $SecondPoints += $second->point ?>
                    @endforeach
                    <tr>
                        <td colspan="6"> <strong>Total Points:</strong></td>
                        <td>{{$SecondPoints}}</td>
                    </tr>
        
                </tbody>
            </table>

                    <strong><p class="text-center">Average: {{ ($FirstPoints + $SecondPoints) / 2.0 }}</p></strong>
                    
            </div>  


                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
