@extends('layouts.admin')

@section('title')
  Admin Requests
@stop

{{-- Content --}}
@section('content')
	@parent
	<div class="container">

		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif

		<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li class="active">Requests</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.requests',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Requests ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('asset', Input::get('asset')) }}
				{{ Form::hidden('status', Input::get('status')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			<nav class="navbar navbar-nav navbar-left">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Requests per page <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 requests</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 requests</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 requests</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 requests</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 requests</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> Requests by Asset Clasee<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php 
								$types = Config::get('ilosool.type');
							?>
							@foreach($types as $key => $value)
								<li><a href="{{ query_url(URL::current(), array('asset' => strtolower($key)) )}}">{{ $value }}</a></li>
							@endforeach
						</ul>
					</li>
					<li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('status')) ? (Input::get('status') ? 'Approved' : 'Unapproved') : ' Approved ' }}<b class="caret"></b></a>
				        <ul class="dropdown-menu">
				          <li><a href="{{ query_url(URL::current(), array('status' => 1))}}">Approved</a></li>
				          <li><a href="{{ query_url(URL::current(), array('status' => 0))}}">Unapproved</a></li>
        				</ul>
 				 	</li>
				</ul>
			</nav>
		</nav>
		<table class="table table-striped table-hover">
	        <thead>
	            <tr>
	                <th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'id', 'order' => 
						( Input::get('col') == 'id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="id"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

	                <th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'user', 'order' => 
						( Input::get('col') == 'user' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="user">User <span class="glyphicon order-arrow {{ Input::get('col') == 'user' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'nickname', 'order' => 
						( Input::get('col') == 'nickname' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="nickname">Nickname <span class="glyphicon order-arrow {{ Input::get('col') == 'nickname' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

	                <th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'asset', 'order' => 
						( Input::get('col') == 'asset' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="asset">Asset Class <span class="glyphicon order-arrow {{ Input::get('col') == 'asset' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'status', 'order' => 
						( Input::get('col') == 'status' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="status">Status <span class="glyphicon order-arrow {{ Input::get('col') == 'status' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					
					<th width="15"><span class="glyphicon glyphicon-ok-sign action"></span></th>
					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
	            </tr>
	        </thead>
			<tbody>
				@if(count($requests) > 0)
			        @foreach($requests as $request)
			            <tr>  
				            <td>{{ $request->id }}</td>
				            <td>{{ $request->user->firstname . ' ' . $request->user->lastname }}</td>
				            <td>{{ $request->user->nickname ? $request->user->nickname : 'Not defined' }}</td>
				            <td>{{ Config::get('ilosool.type.'.$request->asset_class) }}</td>
				            <td>{{ $request->status ? 'Approved' : 'Unapproved' }}</td>
				            <td>
								@if($request->status == 0 )
									<a href="{{ URL::route('admin.request.approve',array($request->id, 1)) }}" title="Unapproved" class="confirm-action" data-name="{{ $request->name }}" data-action="approve"><span class="glyphicon glyphicon-ok-sign action unapproved"></span></a>
								@else
									<a href="{{ URL::route('admin.request.approve', array($request->id, 0)) }}" title="Approved" class="confirm-action" data-name="{{ $request->name }}" data-action="unapprove"><span class="glyphicon glyphicon-ok-sign action"></span></a>
								@endif
							</td>
				            <td><a href="{{ URL::route('admin.request.view', $request->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
			            </tr>
				    @endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
	    <div style="text-align:center">
	    	{{ $requests->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows'), 'type' => Input::get('type') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop