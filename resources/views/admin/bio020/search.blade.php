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
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>BIO 020 </li>
    </ol>
</div>

	<hr>
	<div class="container" style="background-color: #fff;">
	<div class="row">
	<div class="col-md-6">

		<form class="form-inline" action="{{ route('bio020.import') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
		  <input type="file" class="form-control" name="file">
		  <button type="submit" class="btn btn-md btn-primary">Import</button>
		</form>
		</div>

        <div class="col-md-4">
        <form action="{{ route('bio020.search') }}" method="GET" class="form-inline" style="padding-left:60px;">
    <input type="text" name="query" id="query" value="{{ request()->input('query') }}"  placeholder="Search for results" required>
    <button type="submit" style="padding-right:10px;"><i class="fa fa-search" style="width:30px;"></i></button>
        </form>
        </div>

     <div class="col-md-2">
		<h3 align="right">
		<a href="{{ route('bio020.index')}}" class="btn btn-sm btn-primary">Back</a>
		</h3>
	</div>

	</div>
	<br>
		

		<div class="row">
		<div class="col-md-6">
		<br>
			<h2>Search Results (BIO 020)</h2>

		</div>
		<div class="col-md-6">
		<br>
			<!-- <h1>Search Results</h1> -->
        <strong><h3>{{ $bio020->total() }} result(s) for '{{ request()->input('query') }}'</h3></strong>

        </div>
		</div>
		</div>

	<div class="container" style="background-color: #fff;">	
	<div class="row">
	<div class="col-md-12">
			<table class="table">
				<thead>

				@if ($bio020->total() > 0)
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
						<th style="color:grey;">Created At</th>
						<th style="color:grey;">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($bio020 as $bio2)
						<tr>
							<td style="color:brown;">{{ $bio2->id }}</td>
							<td style="color:brown;">{{ $bio2->regNo }}</td>
							<td style="color:brown;">{{ $bio2->lastName }}, {{ $bio2->otherNames }}</td>
							<td style="color:brown;">{{ $bio2->gender }}</td>
							<td style="color:brown;">{{ $bio2->state }}</td>
                            <td style="color:brown;">{{ $bio2->assessment }}</td>
                            <td style="color:brown;">{{ $bio2->exam }}</td>
                            <td style="color:brown;">{{ $bio2->total }}</td>
                            <td style="color:brown;">{{ $bio2->grade }}</td>
                            <td style="color:brown;">{{ $bio2->point }}</td>
							<td>{{ date('M j, Y', strtotime($bio2->created_at)) }}</td>
							<td><a href="{{ route('bio020.show', $bio2->id)}}" class=" btn btn-default btn-sm"> View </a>  <a href="{{ route('bio020.edit', $bio2->id)}}" class="btn btn-success btn-sm" >Edit</a></td>
						</tr>
					@endforeach

					@else
					<h3 align="center" style="color:brown;">No Record Found</he>
				@endif
				
				</tbody>
			</table>
	</div>	
	</div>	
	</div>
		<br>
		<div class="container"> 
               <h5 align="center"> {{ $bio020->appends(request()->input())->links() }} </h5>
        </div>


@endsection

