@extends('layouts.admin')

@section('title')
  Admin Enquiries
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
		  <li class="active">Enquiries</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.enquiries',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Enquiries ...')) }}
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
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Enquiries per page <b class="caret"></b></a>
				        <ul class="dropdown-menu">
				          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 enquiries</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 enquiries</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 enquiries</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 enquiries</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 enquiries</a></li>
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
					)) }}" name="title"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'title', 'order' => 
						( Input::get('col') == 'title' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Title <span class="glyphicon order-arrow {{ Input::get('col') == 'title' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'from', 'order' => ( Input::get('col') == 'from' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="from">From <span class="glyphicon order-arrow {{ Input::get('col') == 'from' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'to', 'order' => ( Input::get('col') == 'to' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="to">To <span class="glyphicon order-arrow {{ Input::get('col') == 'to' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></span></a></th>

					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => ( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></span></a></th>

					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'status', 'order' => ( Input::get('col') == 'status' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="status">Status <span class="glyphicon order-arrow {{ Input::get('col') == 'status' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(('enquiry.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
					
				</tr>
			</thead>
			<tbody>
				@if(count($enquiries) > 0)
					@foreach($enquiries as $enquiry)
						<tr>
							<td>{{ $enquiry->id }}</td>
							<td>{{ $enquiry->title }}</td>
							<td>{{ $enquiry->from }}</td>
							<td>{{ $enquiry->to }}</td>
							<td>{{ $enquiry->type }}</td>
							<td>{{ $enquiry->status }}</td>
							<td><a href="{{ URL::route('admin.enquiry.view', $enquiry->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('enquiry.delete'))
								<td><a href="{{ URL::route('admin.enquiry.delete', $enquiry->id) }}" title="Delete" class="confirm-action" data-name="enquiry {{ $enquiry->id }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="8" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $enquiries->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop