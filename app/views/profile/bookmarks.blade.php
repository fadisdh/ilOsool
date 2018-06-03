@extends('layouts.user')

@section('title')
  Profile | My Bookmarks
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">{{trans('profile.my_bookmarks.my_bookmarks')}}</h2>
		<div class="row bookmarks-filter clearfix">
			{{ Form::open(array('route' => 'profile.bookmarks', 'method' => 'get')) }}
			<div class="col-md-3">
		        {{ Form::text('search', Input::get('search'), array('class' => 'form-control search animation', 'placeholder' => trans('general.search'))) }}
	    	</div>
	       	<div class="col-md-2">
				<select id="folder-select" class="form-control" name="folder">
		        	<option value="all">{{trans('general.all')}}</option>
		           	<?php
		           	foreach($folders as $folder){
		            	echo '<option "' . (Input::get('folder') == $folder->id ? '" selected=selected "'  :  '" "') . '" value="' . $folder->id . '">' . $folder->name . '</option>';
		            }
		           	?>
		        </select>
		    </div>
		    <div class="col-md-4">
			    {{ Form::submit(trans('general.filter'), array('class' => 'search-btn btn btn-primary')) }}
		       	<a href="{{ URL::current() }}" title="{{trans('general.clear_filter')}}" class="search-btn btn btn-default">{{trans('general.clear_filter')}}</a>
			    {{ Form::close() }}
			</div>
			<div class="col-md-3 add-folder">
				<a href="{{ URL::route('profile.folder.action', array('add', 0)) }}" data-title="{{trans('profile.my_bookmarks.add_new_folder')}}" class="btn btn-primary popup" title="{{trans('profile.my_bookmarks.add_new_folder')}}">{{trans('profile.my_bookmarks.add_new_folder')}}</a>
			</div>
	     </div>
		<ul class="list-unstyled companies-list bookmarks-list row">
			@if(count($bookmarks) > 0)

			@foreach($bookmarks as $bookmark)
				@if (Auth::check())
					<?php $status = $bookmark->grantedAccess(Auth::user()->id, $bookmark->id); ?>
				@endif
				<li class="col-md-4 company-item animation">
					<div class="actions animation">
						<a href="{{URL::route('bookmark.popup', array($bookmark->id, 'move'))}}" data-title="{{trans('profile.my_bookmarks.move_bookmark')}}" class="popup first" title="Move"><span class="glyphicon glyphicon-share-alt"></span> {{trans('general.move')}}</a>
						<a href="{{URL::route('bookmark.popup', array($bookmark->id, 'remove'))}}" data-title="{{trans('profile.my_bookmarks.remove_bookmark')}}" class="popup" title="Remove"><span class="glyphicon glyphicon-remove"></span>  {{trans('general.remove')}}</a>
					</div>
					<a href="{{ $bookmark->slug ? URL::route('company.view', $bookmark->slug) : URL::route('company.view', $bookmark->id) }}" class="company-item-block" title="View">
						<div class="row">
							<img class="col-md-3" src="{{ ($bookmark->logo) ? asset($bookmark->getLogo()) : asset('images/default-logo-img.png') }}" />
							<div  class="col-md-9">
								<h3>{{ (strlen($bookmark->deal_name)>16) ? substr($bookmark->deal_name,0,16) . '...' :  $bookmark->deal_name }}</h3>
								<h4>{{ $bookmark->city }}, {{ $bookmark->country }}</h4>
								<h4>{{ trans('deal_values.'.Config::get('ilosool.type.'. $bookmark->type)) }}</h4>
							</div>
						</div>
						<div class="row company-info">
							<div class="left-info col-md-6">
								<h4>{{trans('profile.my_bookmarks.min_investment')}}</h4>
								<h3>
									@if($bookmark->companyHidden)
										<h3>{{ $bookmark->getPrivateField($bookmark, $bookmark->format($bookmark->min_investment) . ' ' . $bookmark->min_investment_suffix, $bookmark->companyHidden->min_investment, $status, array('pending' => trans('general.private'), 'rejected' => trans('general.private'), 'request' => trans('general.private'))) }}</h3>
									@else
										<h3>{{$bookmark->format($bookmark->min_investment) . ' ' . $bookmark->min_investment_suffix}}</h3>
									@endif
								</h3>
							</div>
							<div  class="right-info col-md-6">
								<h4>{{trans('profile.my_bookmarks.sector')}}</h4>
								<h3>{{ trans('deal_values.'.$bookmark->sector) }}</h3>
							</div>
						</div>

						<!-- Listing Status -->
						<div class="row listing-status ">
							@if($bookmark->listing_status == 'open')
								<img src="{{asset('images/open.png')}}">
								<span class='open'>{{ trans('deal.status.'.$bookmark->listing_status) }}</span>
							@elseif($bookmark->listing_status == 'closed')
								<img src="{{asset('images/closed.png')}}">
								<span class='closed'>{{ trans('deal.status.'.$bookmark->listing_status) }}</span>
							@elseif($bookmark->listing_status == 'negotiation')
								<img src="{{asset('images/negotiation.png')}}">
								<span class='negotiation'>{{ trans('deal.status.'.$bookmark->listing_status) }}</span>
							@else
								<img src="{{asset('images/open.png')}}">
								<span class='open'>{{ trans('deal.status.open') }}</span>
							@endif
						</div> 
						
						<div class="row description-info">
							<p>{{ trimWords($bookmark->brief, 25) }}</p>
						</div>
					</a>
			</li>
			@endforeach
			@else
				<h3 class="no-result">{{trans('profile.my_bookmarks.no_bookmarks')}}</h3>
			@endif
		</ul>
	</div>
	<div class="pagination-tab">
		{{ $bookmarks->appends(array('search' => Input::get('search'), 'folder' => Input::get('folder')))->links(array('class' => 'pagination')) }}
	</div>
@stop
								