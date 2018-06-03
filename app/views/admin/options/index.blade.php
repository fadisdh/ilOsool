@extends('layouts.admin')

@section('title')
  Admin Options
@stop

{{-- Content --}}
@section('content')
	@parent
	<div class="container">

		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif

		<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li class="active">Options</li>
		</ol>
		{{ Form::open(array('route' => 'admin.options.edit', 'class' => 'form-horizontal')) }}
			
			@foreach($options as $key => $val )
				<h1>{{ $key }}</h1>
				@foreach($val as $option)
					<div class="form-group">
						{{ Form::label($option->key, $option->name, array('class' => 'control-label col-md-2')) }}
							<div class="col-md-10">
								@if($option->type == 'textarea')
									{{ Form::textarea($option->key, $option->value, array('class' => 'form-control editor')) }}
									
								@elseif($option->type == 'checkbox')
									<div class="checkbox">
										{{ Form::checkbox($option->key, $option->key, $option->value ? $option->value : null , array('id' => $option->key)) }}
									</div>
								@else
										{{ Form::text($option->key, $option->value, array('class' => 'form-control')) }}
								@endif
						</div>
					</div>
				@endforeach
			@endforeach
			<div class="form-group">
	            <div class="col-md-10 col-md-offset-2">
	                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
	                <a href="{{ URL::route('admin.options') }}" class="btn btn-default">Cancel</a>
	            </div>
	        </div>
    		
		{{ Form::close() }}
	</div>
@stop