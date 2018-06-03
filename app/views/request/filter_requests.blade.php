<div class="filter-sidemenu">
	<div class="filter-box list-unstyled">
		<div class="hline"></div>
		<h3>{{trans('menu.request_filter.serach_requests')}}</h3>
		<div class="search-investments">
			{{ Form::open(array('route' => 'requested.deals', 'method' => 'get')) }}
				<div class="input-group">
		            {{ Form::text('search_requests', Input::get('search_requests'), array('class' => 'form-control search animation', 'placeholder' => trans('menu.request_filter.search'))) }}
		            <span class="input-group-btn">
				    	<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				    </span>
				</div>
	        	{{ Form::hidden('asset_class', $asset_class) }}
	    </div>
	</div>

	<div class="filter-box list-unstyled">
		<div class="filter-tabs clearfix {{ ( $asset_class == 'pe' ? 'yellow-selected' : ($asset_class == 'vc' ? 'green-selected' : ($asset_class == 're' ? 'blue-selected' : '')) )}}">
			<a href="{{ URL::route('requested.deals') }}?asset_class=pe#topmenu" class="col-md-4 yellow-bg animation {{ ( $asset_class == 'pe' ? 'selected' : '' )}}">PE</a>
	        <a href="{{ URL::route('requested.deals') }}?asset_class=vc#topmenu" class="col-md-4 green-bg animation {{ ( $asset_class == 'vc' ? 'selected' : '' )}}">VC</a>
	        <a href="{{ URL::route('requested.deals') }}?asset_class=re#topmenu" class="col-md-4 blue-bg animation {{ ( $asset_class == 're' ? 'selected' : '' )}}">RE</a>
	    </div>	
	</div>
	
	<div class="filter-box list-unstyled">
		<a href="{{ URL::current() }}" title="Clear search data" class="filter-btn clear-filter col-md-12">{{trans('menu.request_filter.clear_filter')}}</a>
	</div>
	{{ Form::close() }}
</div>
