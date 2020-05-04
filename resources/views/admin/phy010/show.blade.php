@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li><a href="{{ route('phy010.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Results Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>View Result</li>
    </ol>
</div>

<br>
<div class="container">
@include('admin.navbar')

<br>
<br>

<div class="jumbotron">
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
							<td>{{ $phy010->id }}</td>
							<td>{{ $phy010->regNo }}</td>
							<td>{{ $phy010->lastName }} ,{{ $phy010->otherNames }} </td>
							<td>{{ $phy010->gender }}</td>
                            <td>{{ $phy010->state }}</td>
                            <td>{{ $phy010->assessment }}</td>
                            <td>{{ $phy010->exam }}</td>
                            <td>{{ $phy010->total }}</td>
                            <td>{{ $phy010->grade }}</td>
                            <td>{{ $phy010->point }}</td>
                            <td>{{ date('M j, Y', strtotime($phy010->created_at)) }}</td>
                            <td>{{ date('M j, Y', strtotime($phy010->updated_at)) }}</td>
						</tr>
				</tbody>
			</table>
	</div>
	</div>

	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('phy010.edit', 'Edit', array($phy010->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['phy010.destroy', $phy010->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>


@endsection