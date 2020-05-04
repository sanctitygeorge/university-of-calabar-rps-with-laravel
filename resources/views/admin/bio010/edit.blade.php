@extends('layouts.app')
@section('title', '| View Post')
@section('content')

<div class="container">
    <ol class="breadcrumb">
    <li> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li><a href="{{ route('bio010.index') }}">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>Results Page</a></li>
    <li class="active">
    <i class="fa fa-chevron-right" style="padding:2px; font-size:10px; width:20px;"></i>BIO010</li>
    </ol>
</div>

<br>
    <div class="container" style="background-color: #fff;">
    @include('admin.navbar')

<br>
{!! Form::model($bio010, array('route' => array('bio010.update', $bio010->id), 'method' => 'PUT')) !!}
    
    <div class="jumbotron">
    <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>

    <div class="row">
    <div class="col-sm-6">
    
        <h4>Last Created:</h4> <p class="lead"> {{ date('M j, Y h:ia', strtotime($bio010->created_at)) }}</p>
         
        </div>
        
        <div class="col-sm-6">
       <h4> Last Updated:</h4> <p class="lead"> {{ date('M j, Y h:ia', strtotime($bio010->updated_at)) }}</p>
        </div>   
    </div> 
    <br>
                        
                    </tr>
                </thead>
                <tbody>
                        <tr style="background-color: #fff;">
                            <td>
    {!! Form::open() !!}
    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
        {{ Form::label('lastName', 'Last Name:') }}
        {{ Form::text('lastName', null, array('class'=>'form-control')) }}

        @if ($errors->has('lastName'))
            <span class="help-block">
                <strong>{{ $errors->first('lastName') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
    <div class="form-group{{ $errors->has('otherNames') ? ' has-error' : '' }}">
        {{ Form::label('otherNames', 'Other Names:') }}
        {{ Form::text('otherNames', null, array('class'=>'form-control')) }}

        @if ($errors->has('otherNames'))
            <span class="help-block">
                <strong>{{ $errors->first('otherNames') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
    <div class="form-group{{ $errors->has('regNo') ? ' has-error' : '' }}">
        {{ Form::label('regNo', 'Reg. No:') }}
        {{ Form::text('regNo', null, array('class'=>'form-control')) }}

        @if ($errors->has('regNo'))
            <span class="help-block">
                <strong>{{ $errors->first('regNo') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
        {{ Form::label('gender', 'Gender:') }}
        {{ Form::text('gender', null, array('class'=>'form-control')) }}

        @if ($errors->has('gender'))
            <span class="help-block">
                <strong>{{ $errors->first('gender') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
        {{ Form::label('state', 'State:') }}
        {{ Form::text('state', null, array('class'=>'form-control')) }}

        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
        <div class="form-group{{ $errors->has('assessment') ? ' has-error' : '' }}">
        {{ Form::label('assessment', 'CA:') }}
        {{ Form::text('assessment', null, array('class'=>'form-control')) }}

        @if ($errors->has('assessment'))
            <span class="help-block">
                <strong>{{ $errors->first('assessment') }}</strong>
            </span>
        @endif
    </div>
                            </td>
                            <td>
     <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
     {{ Form::label('exam', 'Exam:') }}
     {{ Form::text('exam', null, array('class'=>'form-control')) }}

        @if ($errors->has('exam'))
            <span class="help-block">
                <strong>{{ $errors->first('exam') }}</strong>
            </span>
        @endif
     </div>
                            </td>
                        
                        </tr>
                </tbody>

            </table>
    </div>
    <br>
    <div class="row">
    <div class="col-sm-3">
    
        {!! Html::linkRoute('bio010.index', 'Cancel', array($bio010->id), array('class'=>'btn btn-danger btn-block')) !!}
    
        </div>
        
        <div class="col-sm-3">
            {{ Form::submit('Update Changes', ['class'=>'btn btn-success btn-block']) }}
    
        </div>
        
    </div> 
    </div> 
    
    
    {!! Form::close() !!}
</div>
<!-- </div> -->


@endsection