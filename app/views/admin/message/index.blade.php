@extends('layouts.admin')

@section('title')
  Admin {{ ucfirst($messageType) }} Messages
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
			<li><a href="{{ URL::route('admin.users') }}">Users</a></li>
			<li><a href="{{ URL::route('admin.user.view',$id) }}">{{ $username }}</a></li>
			<li class="active"> <?php ( $messageType == "sent" ) ?  print "Sent Messages" : print "Received Messages" ?></li>
		</ol>

		<nav class="navbar navbar-default actions">
			{{ Form::open(array('route' => array('admin.messages.view', $id, $messageType),
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Messages ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			<nav class="navbar navbar-nav navbar-left">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Messages per page <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 messages</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 messages</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 messages</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 messages</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 messages</a></li>
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

	                <th width="50%"><a href="{{ query_url(URL::current(), array('col' => 'title', 'order' => 
						( Input::get('col') == 'title' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Title <span class="glyphicon order-arrow {{ Input::get('col') == 'title' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

	                <th width="40%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15"><span title="View message" class="glyphicon glyphicon-eye-open action"></span></th>
	            </tr>
	        </thead>
		    <tbody>
		    	@if(count($messages) > 0)
			        @foreach($messages as $message)
			            <tr>  
				            <td>{{ $message->id }}</td>
				            <td>{{ trimWords($message->title, 10) }}</td>
				            <td>{{ $message->type }}</td>

				            <td><a href="{{ URL::route('admin.message.view',array($id, $messageType, $message->id)) }}" title="View messsage"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
			            </tr>
			        @endforeach
			    @else
					<tr><td colspan="4" class="empty">No Result found</td></tr>
				@endif
		    </tbody>
	    </table> 
	    <div style="text-align:center">
	    	{{ $messages->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows'), 'type' => Input::get('type') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop