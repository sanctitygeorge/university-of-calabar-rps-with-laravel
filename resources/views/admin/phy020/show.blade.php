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
    <li><a href="{{ route('phy020.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Results Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>View Result</li>
    </ol>
</div>

<div class="container">
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
							<td>{{ $phy020->id }}</td>
							<td>{{ $phy020->regNo }}</td>
							<td>{{ $phy020->lastName }} ,{{ $phy020->otherNames }} </td>
							<td>{{ $phy020->gender }}</td>
                            <td>{{ $phy020->state }}</td>
                            <td>{{ $phy020->assessment }}</td>
                            <td>{{ $phy020->exam }}</td>
                            <td>{{ $phy020->total }}</td>
                            <td>{{ $phy020->grade }}</td>
                            <td>{{ $phy020->point }}</td>
                            <td>{{ date('M j, Y', strtotime($phy020->created_at)) }}</td>
                            <td>{{ date('M j, Y', strtotime($phy020->updated_at)) }}</td>
						</tr>
				</tbody>
			</table>
	</div>
	</div>
	</div>

	<div class="container">
	<div class="row">
	<div class="col-md-2">

	{!! Html::linkRoute('phy020.edit', 'Edit', array($phy020->id), array('class'=>'btn btn-primary btn-block')) !!}

	</div>
	
	<div class="col-md-2">

		{!! Form::open(['route' => ['phy020.destroy', $phy020->id], 'method' => 'DELETE']) !!}
	
		{{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) }}
	
			{!! Form::close() !!}

	</div>
	
</div>
</div>


@endsection