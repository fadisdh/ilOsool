<div id="topmenu" class="topmenu">
	<ul class="list-unstyled">
		<li>
			<a href="{{ URL::route('user.home') }}" class="{{ isset($topmenu) && $topmenu == 'home' ? 'selected' : '' }}">{{trans('menu.topmenu.home')}}</a>
		</li>

		<li>
			<a href="{{ URL::route('requested.deals') }}" class="{{ isset($topmenu) && $topmenu == 'requests' ? 'selected' : '' }}">{{trans('menu.topmenu.requested_deals')}}</a>
		</li>
		
		<li>
			<a href="{{ URL::route('profile.bookmarks') }}" class="{{ isset($topmenu) && $topmenu == 'bookamrks' ? 'selected' : '' }}">{{trans('menu.topmenu.bookmarks')}}</a>
		</li>

		@if( Auth::user()->rule_id == 1 || Auth::user()->rule_id == 2 || Auth::user()->rule_id == 4 || Auth::user()->rule_id == 5)
			<li class="parent">
				<a href="#" class="{{ isset($topmenu) && $topmenu == 'companies' ? 'selected' : '' }}">{{trans('menu.topmenu.mylistings')}} / {{trans('menu.topmenu.myrequests')}}</a>
				<ul class="submenu">
					<li><a href="{{ URL::route('profile.companies') }}" class="{{ isset($topmenu) && $topmenu == 'companies' ? 'selected' : '' }}">{{trans('menu.topmenu.mylistings')}}</a></li>
					<li><a href="{{ URL::route('profile.requests') }}" class="{{ isset($topmenu) && $topmenu == 'myrequests' ? 'selected' : '' }}">{{trans('menu.topmenu.myrequests')}}</a></li>
				</ul>
			</li>
		@endif
		<li>
			<a href="{{ URL::route('profile.view', Auth::user()->id) }}" class="{{ isset($topmenu) && $topmenu == 'profile' ? 'selected' : '' }}">{{trans('menu.topmenu.profile')}}</a>
		</li>
		@if( Auth::user()->rule_id == 1 || Auth::user()->rule_id == 2 || Auth::user()->rule_id == 4 || Auth::user()->rule_id == 5)
			<li class="parent">
				<a href="#" class="{{ isset($topmenu) && $topmenu == 'new-listing' ? 'selected' : '' }}">{{trans('menu.topmenu.addnew')}}</a>
				<ul class="submenu">
					<li><a href="{{ URL::route('company.type') }}" class="{{ isset($topmenu) && $topmenu == 'new-listing' ? 'selected' : '' }}">{{trans('menu.topmenu.addlisting')}}</a></li>
					<li><a href="{{ URL::route('request.deal') }}" class="{{ isset($topmenu) && $topmenu == 'request-deal' ? 'selected' : '' }}">{{trans('menu.topmenu.addrequest')}}</a></li>
				</ul>
			</li>
		@endif
		<li class="notifications-list">
			@include('profile.popup_notifications')
		</li>
		<li class="notifications-list">
			@include('profile.popup_messages')
		</li>
	</ul>
</div>