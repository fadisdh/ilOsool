@extends('layouts.master')

@section('title')
  Deal View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Description</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->description}}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">brief</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->brief }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Image</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val"><img src="{{ asset($deal->getImage()) }}" /></div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Video</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->video }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@foreach ($deal->type  as $val)
	    			@if (  array_key_exists($val, Config::get('ilosool.investment_stage')) )
	    			   	{{ Config::get('ilosool.investment_stage.'. $val) . '<br />' }}
		            @endif
		    	@endforeach
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Start Date</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->startdate }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Duration</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->duration }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Target</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->target }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Tags</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $deal->tags }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Geo Interest</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
	    		@foreach ($deal->geo_interest  as $val)
	    			@if (  array_key_exists($val, Config::get('ilosool.geo_interest')) )
	    			   	{{ Config::get('ilosool.geo_interest.'. $val) . '<br />'}}
		            @endif
		    	@endforeach
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Investment Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
	    		@foreach ($deal->investment_type  as $val)
		            @if (  array_key_exists($val, Config::get('ilosool.investment_type')) )
	    			   	{{ Config::get('ilosool.investment_type.'. $val) . '<br />'}}
		            @endif
		    	@endforeach
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Deal Size</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
	    		@foreach ($deal->deal_size  as $val)
		            @if (  array_key_exists($val, Config::get('ilosool.deal_size')) )
	    			   	{{ Config::get('ilosool.deal_size.'. $val) . '<br />'}}
		            @endif	
		    	@endforeach
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Status</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ ucfirst($deal->status) }}</div>
		</div>
	</div>
@stop