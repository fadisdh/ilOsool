
<nav id="admin-navbar" class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	  	<div class="navbar-header">
	  		<div class="logo">
			    <a class="navbar-brand" href="{{ URL::route('admin') }}">
			      {{ HTML::image('images/admin/logo.png') }}
			    </a>
		    </div>
		</div>
		<div>
			<ul class="nav navbar-nav navbar-left">
				@if(can('page.view') || can('post.view') )
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-book"></span> Content System <b class="caret"></b></a>
							<ul class="dropdown-menu">
								@if(can('page.view'))
									<li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
								@endif
								@if(can('post.view'))
									<li><a href="{{ URL::route('admin.posts') }}">Posts</a></li>
								@endif
							</ul>
					</li>
				@endif
				@if(can('user.view') || can('rule.view') )
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> User System <b class="caret"></b></a>
							<ul class="dropdown-menu">
								@if(can('user.view'))
									<li><a href="{{ URL::route('admin.users') }}">Users</a></li>
								@endif
								@if(can('rule.view'))
									<li><a href="{{ URL::route('admin.rules') }}">Rules</a></li>
								@endif
							</ul>
					</li>
				@endif
				@if(can('company.view'))
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-stats"></span> Deals <b class="caret"></b></a>
						<ul class="dropdown-menu">
							@if(can('company.view'))
								<li><a href="{{ URL::route('admin.companies') }}">Listings </a></li>
							@endif
							@if(can('voucher.view'))
								<li><a href="{{ URL::route('admin.vouchers') }}">Vouchers</a></li>
							@endif
							@if(can('request.view'))
								<li><a href="{{ URL::route('admin.requests') }}">Requests</a></li>
							@endif
						</ul>
					</li>
				@endif
				@if(can('enquiry.view') || can('options.view') )
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-info-sign"></span> System <b class="caret"></b></a>
							<ul class="dropdown-menu">
								@if(can('enquiry.view'))
									<li><a href="{{ URL::route('admin.enquiries') }}">Enquiries</a></li>
								@endif
								@if(can('options.view'))
									<li><a href="{{ URL::route('admin.options') }}">Options</a></li>
								@endif
								@if(can('newsletter.view'))
									<li><a href="{{ URL::route('admin.newsletters') }}">Newsletters</a></li>
								@endif
								@if(can('notification.view'))
									<li><a href="{{ URL::route('admin.notifications') }}">Notifications</a></li>
								@endif
							</ul>
					</li>
				@endif
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
				<li><span class="navbar-text">Welcome {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</span></li>
				<li><a href="{{ URL::route('logout') }}"><span class="glyphicon glyphicon-off"></span> logout</a></li>
		  	</ul>
		</div>
	</div>
</nav>
<div class="admin-container">
