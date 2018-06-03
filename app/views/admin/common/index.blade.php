@extends('layouts.admin')

{{-- Content --}}
@section('content')
	@parent
	<div class="container admin-boxes">
		<ul class="list-unstyled">
			@if(can('page.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.pages') }}" class="animation">
						<img src="{{ asset('images/admin/page.png')}}" />
						<h3>Pages</h3>
					</a>
				</li>
			@endif
			@if(can('post.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.posts') }}" class="animation">
						<img src="{{ asset('images/admin/post.png')}}" />
						<h3>Posts</h3>
					</a>
				</li>
			@endif
			@if(can('user.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.users') }}" class="animation">
						<img src="{{ asset('images/admin/user.png')}}" />
						<h3>Users</h3>
					</a>
				</li>
			@endif
			@if(can('rule.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.rules') }}" class="animation">
						<img src="{{ asset('images/admin/rule.png')}}" />
						<h3>Rules</h3>

					</a>
				</li>
			@endif
			@if(can('company.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.companies') }}" class="animation">
						<img src="{{ asset('images/admin/company.png')}}" />
						<h3>Deals</h3>
					</a>
				</li>
			@endif
			<li class="col-md-3 admin-box">
				<a href="{{ URL::route('admin.requests') }}" class="animation">
					<img src="{{ asset('images/admin/newsletter.png')}}" />
					<h3>Requested Deals</h3>
				</a>
			</li>
			@if(can('enquiry.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.enquiries') }}" class="animation">
						<img src="{{ asset('images/admin/enquiry.png')}}" />
						<h3>Enquiries</h3>
					</a>
				</li>
			@endif
			@if(can('options.view'))
				<li class="col-md-3 admin-box">
					<a href="{{ URL::route('admin.options') }}" class="animation">
						<img src="{{ asset('images/admin/option.png')}}" />
						<h3>Options</h3>
					</a>
				</li>
			@endif

			
		</ul>
	</div>
@stop