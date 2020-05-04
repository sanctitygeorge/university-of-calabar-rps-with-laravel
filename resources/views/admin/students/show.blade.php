@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class ="container">
@include('admin.navbar')
</div>
<br>

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li><a href="{{ route('students.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Students' Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>View Data</li>
    </ol>
</div>

<div class="container">
<div class="row">
	
	<div class="col-md-6">
	<div class="well">
			<h5><i> Created At: {{ date('M j, Y h:ia', strtotime($student->created_at)) }}</i></h5>
	</div>

</div>

<div class="col-md-6">
	<div class="well">
			<h5><i>Updated At: {{ date('M j, Y h:ia', strtotime($student->updated_at)) }}</i></h5>
	</div>

</div>
</div>



<div class="container">
<div class="jumbotron">
<div class="col-md-12">
			<table class="table">
				<thead>
					<tr style="background-color: #fff;">
					
						<th>Last Name</th>
						<th>Other Names</th>
						<th>Reg.No</th>
						<th>Phone No</th>
						<th>Gender</th>
						<th>State</th>
						<th>Email</th>
						<!-- <th>Created</th> -->
					</tr>
				</thead>
				<tbody>

						<tr style="background-color: #fff;">
							<td>{{ $student->lastName }}</td>
							<td>{{ $student->otherNames }}</td>
							<td>{{ $student->regNo }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->state }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->point }}</td>
                            <!-- <td>{{ date('M j, Y', strtotime($student->created_at)) }}</td> -->
                            <!-- <td>{{ date('M j, Y', strtotime($student->updated_at)) }}</td> -->
						</tr>
				</tbody>
			</table>
	</div>
	</div>
	</div>

	<div class="container">
	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('students.edit', 'Edit', array($student->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['students.destroy', $student->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>
</div>



@endsection