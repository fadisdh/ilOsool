	<div class="sidemenu">
	<div class="hline"></div>
	<ul class="list-unstyled">
		<li class="profile-username clearfix">
			<img src="{{ (Auth::user()->image) ? asset(Auth::user()->getImage()) : asset('images/default-staff-img.png') }}" class="col-md-3" />
			<div class="col-md-9">
				@if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.company')))
					{{ Auth::user()->company_name }}
				@else
					{{ Auth::user()->nickname ?  Auth::user()->nickname : Auth::user()->firstname . ' ' . Auth::user()->lastname }}
				@endif
				@if (  array_key_exists( Auth::user()->rule_id, Config::get('ilosool.rules')) )
	    		   	<h4 class="user-type">{{ Config::get('ilosool.rules.'. Auth::user()->rule_id) == 'both' ? 'Lister/Seeker' : trans('general.'.ucfirst(Config::get('ilosool.rules.'. Auth::user()->rule_id)))}}</h4>
		        @endif
			</div>
		</li>
		<li class="{{ isset($sidemenu) && $sidemenu == 'info' ? 'selected' : '' }}">
			<a href="{{ URL::route('profile') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-user"></span>&nbsp; {{trans('profile.sidemenu.profile_info')}}</a>
		</li>
		@if(Auth::user()->rule->hasPermission('investment.add'))
			<li class="{{ isset($sidemenu) && $sidemenu == 'investment' ? 'selected' : '' }}">
				<a href="{{ URL::route('profile.investment') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-usd"></span>&nbsp; {{trans('profile.sidemenu.investment_info')}}</a>

				<ul id="" class="list-unstyled submenu">
					<li>
						<a href="{{ URL::route('profile.investment.pe') }}#topmenu" class="submenu-item {{ isset($submenu) && $submenu == 'investment-pe' ? 'selected' : '' }}">{{trans('profile.sidemenu.private_equity')}}</a>
					</li>
					<li>
						<a href="{{ URL::route('profile.investment.vc') }}#topmenu" class="submenu-item {{ isset($submenu) && $submenu == 'investment-vc' ? 'selected' : '' }}">{{trans('profile.sidemenu.venture_capital')}}</a>
					</li>
					<li>
						<a href="{{ URL::route('profile.investment.re') }}#topmenu" class="submenu-item {{ isset($submenu) && $submenu == 'investment-re' ? 'selected' : '' }}">{{trans('profile.sidemenu.real_estate')}}</a>
					</li>
				</ul>
			</li>
		@endif
		@if(Auth::user()->rule->hasPermission('company.add'))
			<li class="{{ isset($sidemenu) && $sidemenu == 'companies' ? 'selected' : '' }}">
				<a href="{{ URL::route('profile.companies') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-th-list"></span>&nbsp; {{trans('profile.sidemenu.my_listings')}}</a>
			</li>
		@endif
		<li class="{{ isset($sidemenu) && $sidemenu == 'requests' ? 'selected' : '' }}">
			<a href="{{ URL::route('profile.requests') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-th-list"></span>&nbsp; {{trans('profile.sidemenu.my_requests')}}</a>
		</li>
		<li class="{{ isset($sidemenu) && $sidemenu == 'bookmarks' ? 'selected' : '' }}">
			<a  href="{{ URL::route('profile.bookmarks') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-book"></span>&nbsp; {{trans('profile.sidemenu.my_bookmarks')}}</a>

			<ul id="bookmarks-sub" class="list-unstyled submenu">
				<?php $folders = User::getUserFolders(Auth::user()->id); ?>
				@foreach($folders as $folder)
					<li>
						<a href="{{ Route('profile.bookmarks')}}?folder={{$folder->id}}#topmenu" class="submenu-item {{ Input::get('folder') == $folder->id ? 'selected' : '' }}"><span class="glyphicon glyphicon-folder-close"></span> {{$folder->name}}</a>
						@if($folder->default != true)
							<div class="folder-action">
								<a href="{{ Route('profile.folder.action', array('edit',$folder->id))}}" class="popup" title="{{trans('profile.my_bookmarks.edit_folder')}}" data-title="{{trans('profile.my_bookmarks.edit_folder')}}"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="{{ Route('profile.folder.action', array('delete', $folder->id))}}" class="popup" title="{{trans('profile.my_bookmarks.remove_folder')}}" data-title="{{trans('profile.my_bookmarks.remove_folder')}}"><span class="glyphicon glyphicon-remove"></span></a>
							</div>
						@endif
					</li>
				@endforeach
			</ul>
		</li>
		<li class="{{ isset($sidemenu) && $sidemenu == 'notifications' ? 'selected' : '' }}">
			<a href="{{ URL::route('profile.notifications') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; {{trans('profile.sidemenu.notifications')}}</a>
		</li>
		<li class="{{ isset($sidemenu) && $sidemenu == 'messages' ? 'selected' : '' }}">
			<a href="{{ URL::route('messages') }}#topmenu" class="sidemenu-item"><span class="glyphicon glyphicon-envelope"></span>&nbsp; {{trans('profile.sidemenu.messages')}}</a>
		</li>
	</ul>
</div>
