@extends('layouts.site')

@section('title')
  Staff Add
@stop

@section('content')
<div class="profile">
    <div class="page-img">{{ HTML::image('images/earlyaccess.jpg') }}</div>
    <div class="container-fluid">
        <div class="profile-container">
                @include('profile.topmenu')
                @if(isset($action))
                    <div class="alert {{ $result ? 'alert-success' : 'alert-danger' }}">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                @endif
                {{ Form::open(array('route' => array('staff.post', $companyId),
                                'files' => true,
                                'class' => 'form-horizontal')) }}
                    @include('staff.form')

                {{ Form::token(); }}
            
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                        <a href="{{ URL::route('companies') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop