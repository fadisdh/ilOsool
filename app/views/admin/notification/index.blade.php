@extends('layouts.admin')

@section('title')
	Admin Notifications
@stop

{{-- Content --}}
@section('content')
	@parent
	<div class="container">
		@if( count($notifications) > 0 )

			@foreach($notifications as $ntf)

			<div class="row adminview-row">
				<div class="col-md-2 adminview-key">{{$ntf->title}}</div>
			    <div class="col-md-9 col-md-offset-1 adminview-val">{{$ntf->description}}</div>
			</div>
				
			@endforeach
		@else
			<h3>No Results found</h3>
		@endif
		<div style="text-align:center">
	    	{{ $notifications->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop