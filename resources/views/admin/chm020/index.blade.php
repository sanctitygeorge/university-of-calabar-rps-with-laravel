@extends('layouts.app')
@section('content')


    <div class ="container">
    @include('admin.navbar')

    @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
<br>

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <!-- <li><a href="{{ route('students.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i> View Students</a></li> -->
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>CHM 020</li>
    </ol>
</div>

	<hr>
	<div class="container" style="background-color: #fff;">
	<div class="row">
	<div class="col-md-6">

		<form class="form-inline" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
		  <input type="file" class="form-control" name="file">
		  <button type="submit" class="btn btn-md btn-primary">Import</button>
		</form>
		</div>


		<div class="col-md-4">
        <form action="{{ route('chm020.search') }}" method="GET" class="form-inline" style="padding-left:60px;">
    <input type="text" name="query" id="query" value="{{ request()->input('query') }}"  placeholder="Search for results" required>
    <button type="submit" style="padding-right:10px;"><i class="fa fa-search" style="width:30px;"></i></button>
        </form>
        </div>

	<div class="col-md-2">
		<h3 align="right">
		<a href="{{ route('chm020.create')}}" class="btn btn-sm btn-primary"> Add New Result</a>
		<br><a href="{{ route('chm020.truncate')}}" class="btn btn-sm btn-danger">Delete All Results</a>
		</h3>
	</div>  

	</div>
	<br>
		

		<div class="col-md-12">
	<hr>
			<h2 align="center">Introduction to Organic Chemistry 2 (CHM 020)  Results Sheet</h2>

		</div>
		</div>

	<div class="container" style="background-color: #fff;">	
	<div class="row">
	<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th style="color:grey;">S/N</th>
						<th style="color:grey;">Reg. No</th>
						<th style="color:grey;">Name</th>
						<th style="color:grey;">Gender</th>
						<th style="color:grey;">State</th>
						<th style="color:grey;">CA</th>
						<th style="color:grey;">Exam</th>
						<th style="color:grey;">Total</th>
						<th style="color:grey;">Grade</th>
                        <th style="color:grey;">Point</th>
						<!-- <th style="color:grey;">Created At</th> -->
						<th style="color:grey;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($chm020 as $chm2)
						<tr>
							<td style="color:brown;">{{ $chm2->id }}</td>
							<td style="color:brown;">{{ $chm2->regNo }}</td>
							<td style="color:brown;">{{ $chm2->lastName }}, {{ $chm2->otherNames }}</td>
							<td style="color:brown;">{{ $chm2->gender }}</td>
							<td style="color:brown;">{{ $chm2->state }}</td>
                            <td style="color:brown;">{{ $chm2->assessment }}</td>
                            <td style="color:brown;">{{ $chm2->exam }}</td>
                            <td style="color:brown;">{{ $chm2->total }}</td>
                            <td style="color:brown;">{{ $chm2->grade }}</td>
                            <td style="color:brown;">{{ $chm2->point }}</td>
							<!-- <td>{{ date('M j, Y', strtotime($chm2->created_at)) }}</td> -->
							<td><a href="{{ route('chm020.show', $chm2->id)}}" class=" btn btn-default btn-sm"> View </a>  <a href="{{ route('chm020.edit', $chm2->id)}}" class="btn btn-success btn-sm" >Edit</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
	</div>	
	</div>	
	</div>
		<br>
		<div class="container"> 
               <h5 align="center"> {{ $chm020->appends(request()->input())->links() }} </h5>
        </div>


@endsection

