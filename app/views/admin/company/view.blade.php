@extends('layouts.admin')

@section('title')
	Admin Company View
@stop

@section('content')
@parent

<div class="container adminview">
	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
	  <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
	  <li class="active">{{ $company->name }}</li>
	  <li class="pull-right"><a href="{{ URL::route('admin.company.attachments', $company->id) }}" class="label label-default"><span class="glyphicon glyphicon-cloud-download action"></span> Attachments</a></li>
	  <li class="pull-right"><a href="{{ URL::route('admin.company.staff', $company->id) }}" class="label label-default"><span class="glyphicon glyphicon-user action"></span> Staff</a></li>
	  <li class="pull-right"><a href="{{ URL::route('admin.company.edit', $company->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
	</ol>

	<div class="row adminview-row">
	    <div class="col-md-9 adminview-val"><span class="label label-success">Basic Info</span></div>
	</div>	

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">ID</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->id }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Owner Name</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val"><a href="{{ URL::route('admin.user.view', $user->id)}}">{{ $user->firstname . ' ' . $user->lastname }}</a></div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Deal Name</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->deal_name }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Listing Name</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->name }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Arabic Name</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->name_arabic }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Founded Year</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->started }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Description</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->description }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Brief</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->brief }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Image</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if($company->image)
	        	<img class="adminview-image" src="{{ asset($company->getImage()) }}" />
	       	@else
	            <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_company_image')) }}" />
	        @endif
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Logo</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if($company->logo)
	        	<img class="adminview-image" src="{{ asset($company->getLogo()) }}" />
	       	@else
	            <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_company_image')) }}" />
	        @endif
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Video</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->video }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Tags</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->tags }}</div>
	</div>

	<div class="row adminview-row">
	    <div class="col-md-9 adminview-val"><span class="label label-success">Contact Info</span></div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Address</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->address }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">City</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->city }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Country</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->country }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Phone</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->phone }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Email</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->email }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Website</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->website }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Map</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	        <script>
	            function initialize() {
	              var marker = null;
	              var pos="<?php echo $company->map; ?>";
	              var setMarker = false;
	              if(pos){
	                setMarker = true;
	              }else{
	                pos = '26.194877,23.598633';
	              }
	              pos = pos.split(',');

	              var map = new google.maps.Map(document.getElementById('map-canvas'), {
	                zoom: 8,
	                center: new google.maps.LatLng(pos[0], pos[1])  
	              });

	              if(setMarker){
	                var latlng = new google.maps.LatLng(pos[0], pos[1]);
	                 marker = new google.maps.Marker({
	                  position: latlng,
	                  map: map
	                });

	                map.panTo(latlng);
	              }
	            }
	            google.maps.event.addDomListener(window, 'load', initialize);
	        </script>
	        <div id="map-canvas" style="height:250px;"></div>
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Social Links</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@foreach( $company->social as $key => $value)
	    		@if($value)
	    			{{ $key . ': ' . $value }}<br />
	    		@endif
	    	@endforeach
	    </div>
	</div>

	<div class="row adminview-row">
	    <div class="col-md-9 adminview-val"><span class="label label-success">Investment Details</span></div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Type</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ Config::get('ilosool.type.'.$company->type) }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Geo Interest</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	{{ implode(', ', $company->geo_interests) }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Sector</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	{{ $company->sector }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Investment Stage</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	{{ $company->investment_stage }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Investment Target</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->format($company->target) . ' ' . $company->target_suffix }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Investment Type</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	{{ $company->investment_type }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Investment Style</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	{{ $company->investment_style  }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Deal Size</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->deal_size }}
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Commission from Buyer</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->cfb . '%'}}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Starting Date</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->startdate }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Ending Date</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->enddate }}</div>
	</div>

	@if($company->type == 're')
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Yield</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->yield . '%' }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Built Up Area</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->number_sqf . ' ' . $company->number_sqf_suffix }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Price per Area Unit</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->format($company->price_sqf) . ' ' . $company->price_sqf_suffix }}</div>
		</div>
	@endif

	@if($company->type == 'vc' || $company->type == 'pe')
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Price per Share</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{  $company->format($company->price_shares) . ' ' . $company->price_shares_suffix }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Number of Shares</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->format($company->number_shares) }}</div>
		</div>

		<div class="row adminview-row">
			
			@if($company->type == 'vc')
				<div class="col-md-2 adminview-key">Revenue</div>	
			@elseif($company->type == 'pe')
				<div class="col-md-2 adminview-key">Price Earning (P/E)</div>
			@endif

		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->price_earning . 'x' }}</div>

		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Percentage from Company</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->percentage . '%' }}</div>
		</div>
	@endif

	@if($company->type == 'vc')
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Growth Rate</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->growth_rate . '%' }}</div>
		</div>
	@endif

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Leverage Ratio</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->leverage_ratio . '%' }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Minimum Investment</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->format($company->min_investment) . ' ' . $company->min_investment_suffix }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Current & Target</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $company->format($company->current) }} of {{ $company->format($company->target) . ' ' . $company->target_suffix }}</div>
	</div>

	<div class="row adminview-row">
	    <div class="col-md-9 adminview-val"><span class="label label-success">Admin Config</span></div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">featured</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if (array_key_exists($company->featured, Config::get('ilosool.company_featured')))
	   		  	{{ Config::get('ilosool.company_featured.'. $company->featured) }}
	        @endif</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Show Contact info</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if (array_key_exists($company->show_contact, Config::get('ilosool.show_contact')))
	   		  	{{ Config::get('ilosool.show_contact.'. $company->show_contact) }}
	        @endif</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Status</div>	
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if (array_key_exists($company->status, Config::get('ilosool.deal_status')))
	   		  	{{ Config::get('ilosool.deal_status.'. $company->status) }}
	        @endif
	    </div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Approved</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
	    	@if (array_key_exists($company->approved, Config::get('ilosool.company_approved')))
	   		  	{{ Config::get('ilosool.company_approved.'. $company->approved) }}
	        @endif</div>
	</div>

</div>

@stop