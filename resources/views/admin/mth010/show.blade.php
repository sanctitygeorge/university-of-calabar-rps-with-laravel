@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
@include('admin.navbar')
</div>
<br>
<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li><a href="{{ route('mth010.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Results Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>MTH010</li>
    </ol>
</div>

<div class="container">
<div class="jumbotron">
<h3 align="center">MTH010</h3>
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
							<td>{{ $mth010->id }}</td>
							<td>{{ $mth010->regNo }}</td>
							<td>{{ $mth010->lastName }} ,{{ $mth010->otherNames }} </td>
							<td>{{ $mth010->gender }}</td>
                            <td>{{ $mth010->state }}</td>
                            <td>{{ $mth010->assessment }}</td>
                            <td>{{ $mth010->exam }}</td>
                            <td>{{ $mth010->total }}</td>
                            <td>{{ $mth010->grade }}</td>
                            <td>{{ $mth010->point }}</td>
                            <td>{{ date('M j, Y', strtotime($mth010->created_at)) }}</td>
                            <td>{{ date('M j, Y', strtotime($mth010->updated_at)) }}</td>
						</tr>
				</tbody>
			</table>
	</div>
	</div>

	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('mth010.edit', 'Edit', array($mth010->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['mth010.destroy', $mth010->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>
</div>

@endsection