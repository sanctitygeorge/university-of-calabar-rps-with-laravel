@extends('layouts.app')
@section('content')
<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li><a href="{{ route('eng010.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i> All Results</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Add Result</li>
    </ol>
</div>


<div class="container">

@include('admin.navbar')

<br>
<div class="row">
<div class="col-md-4 col-md-offset-2">
        <h3>Add New Result(ENG 010) </h3>
<hr>
    {!! Form::open(array('route' => 'eng010.store')) !!}
    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
     {{ Form::label('lastName', 'Last Name:') }}
     {{ Form::text('lastName', null, array('class'=>'form-control')) }}

        @if ($errors->has('lastName'))
            <span class="help-block">
                <strong>{{ $errors->first('lastName') }}</strong>
            </span>
        @endif
     </div>

    <div class="form-group{{ $errors->has('otherNames') ? ' has-error' : '' }}">
     {{ Form::label('otherNames', 'Other Names:') }}
     {{ Form::text('otherNames', null, array('class'=>'form-control')) }}

        @if ($errors->has('otherNames'))
            <span class="help-block">
                <strong>{{ $errors->first('otherNames') }}</strong>
            </span>
        @endif
     </div>

<div class="form-group{{ $errors->has('regNo') ? ' has-error' : '' }}">
     {{ Form::label('regNo', 'Reg. No:') }}
     {{ Form::text('regNo', null, array('class'=>'form-control')) }}

        @if ($errors->has('regNo'))
            <span class="help-block">
                <strong>{{ $errors->first('regNo') }}</strong>
            </span>
        @endif
     </div>


    {{ Form::label('gender', 'Gender:') }}
    <select name="gender" class="form-control">
            <option value='Male'>Male</option>
            <option value='Male'>Female</option>
    </select>

<br>
<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
     {{ Form::label('state', 'State:') }}
     {{ Form::text('state', null, array('class'=>'form-control')) }}

        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
     </div>

    <div class="form-group{{ $errors->has('assessment') ? ' has-error' : '' }}">
        {{ Form::label('assessment', 'Assessment Score:') }}
        {{ Form::text('assessment', null, array('class'=>'form-control')) }}

        @if ($errors->has('assessment'))
            <span class="help-block">
                <strong>{{ $errors->first('assessment') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
     {{ Form::label('exam', 'Exam:') }}
     {{ Form::text('exam', null, array('class'=>'form-control')) }}

        @if ($errors->has('exam'))
            <span class="help-block">
                <strong>{{ $errors->first('exam') }}</strong>
            </span>
        @endif
     </div>


    {{ Form::submit('Add Result', array('class'=>'btn btn-success btn-lg', 'style'=>'margin-top:20px;')) }}

    
    {!! Form::close() !!}
     
</div>
</div>
</div>
@endsection
