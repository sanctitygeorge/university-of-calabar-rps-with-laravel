@extends('layouts.app')
@section('content')

<div class ="container">
@include('admin.navbar')
</div>
<br>

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <!-- <li><a href="{{ route('students.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i> View Students</a></li> -->
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>View Students</li>
    </ol>
</div>


<div class="container">

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


	<hr>
	<div class="container" style="background-color: #fff;">
	<div class="row">
	<!-- <div class="col-md-6">

		<form class="form-inline" action="{{ route('students.import')}}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
		  <input type="file" class="form-control" name="file">
		  <button type="submit" class="btn btn-md btn-primary">Import</button>
		</form>
		</div> -->


		<div class="col-md-6">
        <form action="{{ route('students.search')}}" method="GET" class="form-inline" style="padding-left:60px;">
    <input type="text" name="query" id="query" value="{{ request()->input('query') }}"  placeholder="Search for results" required>
    <button type="submit" style="padding-right:10px;"><i class="fa fa-search" style="width:30px;"></i></button>
        </form>
        </div>

	<div class="col-md-6">
		<h3 align="right">
		<a href="{{ route('students.create')}}" class="btn btn-sm btn-primary"> Add New Student</a>
		</h3>
	</div>  

	</div>
	<br>


		<div class="col-md-12">
	<hr>
			<h2 align="center">Students Profile</h2>

		</div>
		</div>

	<div class="container" style="background-color: #fff;">	
	<div class="row">
	<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Reg. Number</th>
						<th>Last Name</th>
						<th>Other Names</th>
						<th>Phone</th>
						<th>Gender</th>
						<th>State</th>
						<th>Email</th>
						<th>Password</th>
						<!-- <th>Date Created</th> -->
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($students as $student)
						<tr>
							<td>{{ $student->id }}</td>
							<td>{{ $student->regNo }}</td>
							<td>{{ $student->lastName }}</td>
							<td>{{ $student->otherNames }}</td>
							<td>{{ $student->phone }}</td>
							<td>{{ $student->gender }}</td>
							<td>{{ $student->state }}</td>
							<td>{{ $student->email }}</td>
							<td>{{ $student->password }}</td>
							<!-- <td>{{ date('M j, Y', strtotime($student->created_at)) }}</td> -->
							<td>
							<a href="{{ route('students.show', $student->id)}}"  class=" btn btn-default btn-sm"> view</a>  
							<a href="{{ route('students.edit', $student->id)}}" ><i class="fa fa-edit"></i></a>
							<a href="{{ route('students.destroy', $student->id)}}" ><i class="fa fa-delete"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	</div>	
	</div>	
	</div>
	<br>
		<div class="container"> 
               <h5 align="center"> {{ $students->appends(request()->input())->links() }} </h5>
        </div>



@endsection

