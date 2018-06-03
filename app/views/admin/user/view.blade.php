@extends('layouts.admin')

@section('title')
  Admin User View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.users') }}">Users</a></li>
		  <li class="active">{{ $user->firstname . ' ' . $user->lastname }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.user.edit', $user->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">First Name</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->firstname }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Last name</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->lastname }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Nickname</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->nickname }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Email</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->email }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Image</div>
	    	<div class="col-md-9 col-md-offset-1 adminview-val">
				@if($user->image)
		        	<img class="adminview-image" src="{{ asset($user->getImage()) }}" />
		       	@else
		            <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
		        @endif
			</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Date of birth</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->birth }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">City</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->city }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Country</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->country }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Address</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->address }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Phone</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->phone }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Status</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if (array_key_exists($user->status, Config::get('ilosool.user_status')))
	    		  	{{ Config::get('ilosool.user_status.'. $user->status) }}
		        @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Interested</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if ($user->pe_interested)
		    		Interested
		    	@endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Geo interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->pe_geo_interests)
		    		@foreach ($user->pe_geo_interests as $val)
	    			   	{{ $val . '<br />'}}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Sector interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->pe_sector_interests)
		    		@foreach ($user->pe_sector_interests as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Targeted Investment Stage</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">		    	
	    		@if($user->pe_investment_stage)
		    		@foreach ($user->pe_investment_stage as $val)
	    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Targeted Investment Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->pe_investment_type)
			    	@foreach ($user->pe_investment_type as $val)
	    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Targeted Investment Style</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->pe_investment_style)
			    	@foreach ($user->pe_investment_style as $val)
	    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">PE Deal Size</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->pe_deal_size)
			    	@foreach ($user->pe_deal_size as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Interested</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if ($user->vc_interested)
		    		Interested
		    	@endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Geo interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->vc_geo_interests)
		    		@foreach ($user->vc_geo_interests as $val)
		    			{{ $val . '<br />'}}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Sector interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->vc_sector_interests)
		    		@foreach ($user->vc_sector_interests as $val)
		    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Targeted Investment Stage</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">		    	
	    		@if($user->vc_investment_stage)
		    		@foreach ($user->vc_investment_stage as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Targeted Investment Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->vc_investment_type)
			    	@foreach ($user->vc_investment_type as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Targeted Investment Style</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->vc_investment_style)
			    	@foreach ($user->vc_investment_style as $val)
		    			{{  $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">VC Deal Size</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->vc_deal_size)
			    	@foreach ($user->vc_deal_size as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Interested</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if ($user->re_interested)
		    		Interested
		    	@endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Geo interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->re_geo_interests)
		    		@foreach ($user->re_geo_interests as $val)
		    			{{ $val . '<br />'}}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Sector interests</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->re_sector_interests)
		    		@foreach ($user->re_sector_interests as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Targeted Investment Stage</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">		    	
	    		@if($user->re_investment_stage)
		    		@foreach ($user->re_investment_stage as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Targeted Investment Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->re_investment_type)
			    	@foreach ($user->re_investment_type as $val)
		    			{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Targeted Investment Style</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
			    @if($user->re_investment_style)
			    	@foreach ($user->re_investment_style as $val)
		    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">RE Deal Size</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if($user->re_deal_size)
			    	@foreach ($user->re_deal_size as $val)
		    			   	{{ $val . '<br />' }}
			    	@endforeach
			    @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Investor Type</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">
    		   	{{ Config::get('ilosool.investor_type.'. $user->investor_type) }}
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Company Name</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $user->company_name }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Rule</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if (  array_key_exists( $user->rule_id, Config::get('ilosool.rules')) )
	    		   	{{ Config::get('ilosool.rules.'. $user->rule_id) }}
		        @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Confirmed</div>	
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	@if ($user->confirmed == "1")
	    		  	Confirmed
	    		@else
	    			Unconfirmed
		        @endif
		    </div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Subscribed</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
   			   {{ Config::get('ilosool.subscribed.'. $user->subscribed) }}
		    </div>
		</div>
	</div>
@stop