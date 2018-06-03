@extends('layouts.site')

@section('content')
	<div class="profile">
		<div class="page-img">
			<div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
		</div>
		<div class="container-fluid">
			<div class="profile-container">
				@section('topmenu')
					@include('profile.topmenu')
				@show
				<div class="row-fluid clearfix">
					<div class="col-md-3 sidemenu-container">
						@section('sidemenu')
							@include('profile.sidemenu')
						@show
					</div>
					<div class="col-md-9">
						@section('user_content')
							@include('profile.user_content')
						@show
					</div>
				</div>
			</div>
		</div>  
	</div>
@stop
