@extends('layouts.user')

@section('title')
  Profile | Files
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">Files</h2>
		<ul class="files-list list-unstyled">
			@foreach($groups as $key => $val)
			<li class="clearfix">
				<h3 class="company-name">{{ $key }}</h3>
				<ul class="row file-item list-unstyled">
					@foreach($val as $attachment)
						<li class="profile-row clearfix">
							<div class="col-md-10">
								<h4>{{ $attachment->name }}</h4>
							</div>
							<div class="col-md-2">
								<a href="{{ asset($attachment->getFullPath()) }}" target="_blank" title="Get File" class="btn btn-default"><span class="glyphicon glyphicon-cloud-download"></span> Get File</a>
							</div>
						</li>
					@endforeach
				</ul>
			</li>
			@endforeach
		</ul>
	</div>
@stop