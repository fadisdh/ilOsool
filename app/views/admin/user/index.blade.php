@extends('layouts.admin')

@section('title')
  Admin Users
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
		  <li class="active">Users</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.users.get') }}" title="Download Users"><span class="glyphicon glyphicon-download"></span> Download Users</a></li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.users',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Users ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rule', Input::get('rule')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				{{ Form::hidden('subscribed', Input::get('subscribed')) }}
				{{ Form::hidden('confirmed', Input::get('confirmed')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
						</li>
					</ul>
				</nav>
			@if(can('user.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.user.add') }}" title="Add new user"><span class="glyphicon glyphicon-plus-sign"></span> Add new user</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Users per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 users</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 users</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 users</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 users</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 users</a></li>
	        				</ul>
     				 	</li>
     				 	<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> by rule<b class="caret"></b></a>
							<ul class="dropdown-menu">
								@foreach($rules as $rule)
									<li><a href="{{ query_url(URL::current(), array('rule' => strtolower($rule->id)) )}}">{{ $rule->name }}</a></li>
								@endforeach
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> by Subscription<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ query_url(URL::current(), array('subscribed' => 'true' ))}}">Subscribed</a></li>
								<li><a href="{{ query_url(URL::current(), array('subscribed' => 'false' ))}}">Unsubscribed</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> by Confirmation<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{{ query_url(URL::current(), array('confirmed' => 'true' ))}}">Confirmed</a></li>
								<li><a href="{{ query_url(URL::current(), array('confirmed' => 'false' ))}}">Unconfirmed</a></li>
							</ul>
						</li>		
					</ul>
				</nav>
				
			@endif
		</nav>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'id', 'order' => 
						( Input::get('col') == 'id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'firstname', 'order' => 
						( Input::get('col') == 'firstname' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="name">Name <span class="glyphicon order-arrow {{ Input::get('col') == 'firstname' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'nickname', 'order' => 
						( Input::get('col') == 'nickname' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="nickname">Nickname <span class="glyphicon order-arrow {{ Input::get('col') == 'nickname' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'email', 'order' => 
						( Input::get('col') == 'email' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="email">Email <span class="glyphicon order-arrow {{ Input::get('col') == 'email' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'rule_id', 'order' => 
						( Input::get('col') == 'rule_id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="rule_id">Rule <span class="glyphicon order-arrow {{ Input::get('col') == 'rule_id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					
					@if(can('message.view_received'))
						<th width="15"><span title="Sent Messages" class="glyphicon glyphicon-circle-arrow-up action"></span></th>
					@endif

					@if(can('message.view_received'))
						<th width="15"><span title="Received Messages" class="glyphicon glyphicon-circle-arrow-down action"></span></th>
					@endif
					
					<th width="15"><span title="View User" class="glyphicon glyphicon-eye-open action"></span></th>
					
					@if(can('user.edit'))
						<th width="15"><span title="Edit User" class="glyphicon glyphicon-edit action"></span></th>
					@endif

					@if(can('user.delete'))
						<th width="15"><span title="Delete User" class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($users) > 0)
					@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->firstname . ' ' . $user->lastname }}</td>
							<td>{{ $user->nickname }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ Rule::getRuleName($user->rule_id) }}</td>
							@if(can('message.view_sent'))
								<th><a href="{{ URL::route('admin.messages.view',array('id' => $user->id, 'messageType' => 'sent')) }}" title="View sent messages"><span class="glyphicon glyphicon-circle-arrow-up action"></span></a></th>
							@endif

							@if(can('message.view_received'))
								<th><a href="{{ URL::route('admin.messages.view',array('id' => $user->id, 'messageType' => 'received')) }}" title="View received messages"><span class="glyphicon glyphicon-circle-arrow-down action"></span></a></th>
							@endif
							
							<td><a href="{{ URL::route('admin.user.view', $user->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							
							@if(can('user.edit'))
								<td><a href="{{ URL::route('admin.user.edit', $user->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif	
							
							@if(can('user.delete'))
								<td><a href="{{ URL::route('admin.user.delete', $user->id) }}" title="Delete" class="confirm-action" data-name="{{ $user->firstname . ' ' . $user->lastname }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="10" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $users->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop