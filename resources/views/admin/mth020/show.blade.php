@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li><a href="{{ route('mth020.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Results Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>MTH020</li>
    </ol>
</div>

<br>
<div class="container">
@include('admin.navbar')

<br>
<br>

<div class="jumbotron">
<h3 align="center">MTH020</h3>
<div class="col-md-12">
			<table class="table">
				<thead>
					<tr style="background-color: #fff;">
					
						<th>ID</th>
						<th>Reg. No</th>
						<th>Name</th>
						<th>Gender</th>
						<th>State</th>
						<th>CA</th>
						<th>Exam</th>
						<th>Total</th>
						<th>Grade</th>
                        <th>Point</th>
						<th>Created At</th>
						<th>Updated At</th>
					</tr>
				</thead>
				<tbody>

						<tr style="background-color: #fff;">
							<td>{{ $mth020->id }}</td>
							<td>{{ $mth020->regNo }}</td>
							<td>{{ $mth020->lastName }} ,{{ $mth020->otherNames }} </td>
							<td>{{ $mth020->gender }}</td>
                            <td>{{ $mth020->state }}</td>
                            <td>{{ $mth020->assessment }}</td>
                            <td>{{ $mth020->exam }}</td>
                            <td>{{ $mth020->total }}</td>
                            <td>{{ $mth020->grade }}</td>
                            <td>{{ $mth020->point }}</td>
                            <td>{{ date('M j, Y', strtotime($mth020->created_at)) }}</td>
                            <td>{{ date('M j, Y', strtotime($mth020->updated_at)) }}</td>
						</tr>
				</tbody>
			</table>
	</div>
	</div>

	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('mth020.edit', 'Edit', array($mth020->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['mth020.destroy', $mth020->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>

@endsection