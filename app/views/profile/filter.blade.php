<div class="filter-sidemenu">
	<div class="filter-box list-unstyled">
		<a href="{{ URL::route('company.type') }}" title="Add New Deal" class="col-md-12 filter-btn-add">{{trans('menu.topmenu.addlisting')}}</a>
	</div>
	<div class="filter-box list-unstyled">
		<div class="hline"></div>
		<h3>{{trans('menu.filter.search_investment')}}</h3>
		<div class="search-investments">
			{{ Form::open(array('route' => 'user.home', 'method' => 'get')) }}
				<div class="input-group">
		            {{ Form::text('search_investments', Input::get('search_investments'), array('class' => 'form-control search animation', 'placeholder' => trans('general.search'))) }}
		            <span class="input-group-btn">
				    	<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
				    </span>
				</div>
	        	{{ Form::hidden('asset_class', $asset_class) }}
	    </div>
	</div>

	<div class="filter-box list-unstyled">
		<div class="filter-tabs clearfix {{ ( $asset_class == 'pe' ? 'yellow-selected' : ($asset_class == 'vc' ? 'green-selected' : ($asset_class == 're' ? 'blue-selected' : '')) )}}">
			<a href="{{ URL::route('user.home') }}?asset_class=pe#topmenu" class="col-md-4 yellow-bg animation {{ ( $asset_class == 'pe' ? 'selected' : '' )}}">PE</a>
	        <a href="{{ URL::route('user.home') }}?asset_class=vc#topmenu" class="col-md-4 green-bg animation {{ ( $asset_class == 'vc' ? 'selected' : '' )}}">VC</a>
	        <a href="{{ URL::route('user.home') }}?asset_class=re#topmenu" class="col-md-4 blue-bg animation {{ ( $asset_class == 're' ? 'selected' : '' )}}">RE</a>
	    </div>
		<!-- <div class="hline"></div>
		<div class="filter-content">
			<div class="checkbox">
                {{ Form::checkbox('pe_interested', '1', Input::get('pe_interested') ? true : null, array('id' => 'pe_interested')) }}
                {{ Form::label('pe_interested', 'PE') }}
            </div>
            <div class="checkbox">
                	{{ Form::checkbox('vc_interested', '1', Input::get('vc_interested') ? true : null, array('id' => 'vc_interested')) }}
                	{{ Form::label('vc_interested', 'VC') }}
            </div>
            <div class="checkbox">
                	{{ Form::checkbox('re_interested', '1', Input::get('re_interested') ? true : null, array('id' => 're_interested')) }}
                	{{ Form::label('re_interested', 'RE') }}
            </div>	
		</div> -->

		@if($asset_class == 'pe')
			<div>
				<h3>{{trans('menu.filter.investment_region')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('geo_interests', 'geo_interests[]',' ', Input::get('geo_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_sector')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('pe_sector_interests', 'pe_sector_interests[]',' ', Input::get('pe_sector_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_size')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('pe_deal_size', 'pe_deal_size[]',' ', Input::get('pe_deal_size')) }}
				</div>
			</div>
			<button type="submit" class="filter-btn col-md-12 animation">{{trans('general.filter')}}</button>
		@elseif ($asset_class == 'vc')
			<div>
				<h3>{{trans('menu.filter.investment_region')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('geo_interests', 'geo_interests[]',' ', Input::get('geo_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_sector')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('vc_sector_interests', 'vc_sector_interests[]',' ', Input::get('vc_sector_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_size')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('vc_deal_size', 'vc_deal_size[]',' ', Input::get('vc_deal_size')) }}
				</div>
			</div>
			<button type="submit" class="filter-btn col-md-12 animation">{{trans('general.filter')}}</button>
		@elseif ($asset_class == 're')
			<div>
				<h3>{{trans('menu.filter.investment_region')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('geo_interests', 'geo_interests[]',' ', Input::get('geo_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_sector')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('re_sector_interests', 're_sector_interests[]',' ', Input::get('re_sector_interests')) }}
				</div>

				<h3>{{trans('menu.filter.investment_size')}}</h3>
				<div class="filter-content">
			        {{ getCheckboxes('re_deal_size', 're_deal_size[]',' ', Input::get('re_deal_size')) }}
				</div>
			</div>
			<button type="submit" class="filter-btn col-md-12 animation">{{trans('general.filter')}}</button>
		@else
			<div class="filter-msg">
				<h3>{{trans('menu.filter.select_asset')}}</h3>
			</div>
		@endif
		
	</div>
	
	<div class="filter-box list-unstyled">
		<div class="hline"></div>
		<h3>{{trans('menu.filter.invst_status')}}</h3>
		<div class="filter-content clearfix">
			<div class="col-md-9">
				@if(getLocale() == 'en')
					{{ Form::select('timer', Config::get('ilosool.listing_status'), Input::get('timer') ? Input::get('timer') : null, array('class' => 'form-control')) }}
				@else
					{{ Form::select('timer', Config::get('ilosool.listing_status_arabic'), Input::get('timer') ? Input::get('timer') : null, array('class' => 'form-control')) }}
				@endif
				
			</div>
			<div class="col-md-3">
				{{ Form::submit(trans('menu.filter.filter'), array('class' => 'btn btn-primary')) }}
			</div>
		</div>
	</div>

	<div class="filter-box list-unstyled">
		<a href="{{ URL::current() }}" title="Clear search data" class="filter-btn clear-filter col-md-12">{{trans('menu.filter.clear_filter')}}</a>
	</div>
	{{ Form::close() }}
</div>
