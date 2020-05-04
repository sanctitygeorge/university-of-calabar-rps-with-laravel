@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li><a href="{{ route('chm010.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>CHM 010</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Edit</li>
    </ol>
</div>

<br>
<div class="container">
@include('admin.navbar')

<br>
<br>

<div class="jumbotron">
<h3 align="center">CHM010</h3>
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
							<td>{{ $chm010->id }}</td>
							<td>{{ $chm010->regNo }}</td>
							<td>{{ $chm010->lastName }}, {{ $chm010->otherNames }} </td>
							<td>{{ $chm010->gender }}</td>
                            <td>{{ $chm010->state }}</td>
                            <td>{{ $chm010->assessment }}</td>
                            <td>{{ $chm010->exam }}</td>
                            <td>{{ $chm010->total }}</td>
                            <td>{{ $chm010->grade }}</td>
                            <td>{{ $chm010->point }}</td>
                            <td>{{ date('M j, Y', strtotime($chm010->created_at)) }}</td>
                            <td>{{ date('M j, Y', strtotime($chm010->updated_at)) }}</td>
						</tr>
				</tbody>
			</table>
	</div>
	</div>

	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('chm010.edit', 'Edit', array($chm010->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['chm010.destroy', $chm010->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>	

@endsection