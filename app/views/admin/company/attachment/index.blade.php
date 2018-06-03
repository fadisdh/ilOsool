@extends('layouts.admin')

@section('title')
	Admin Attachments
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
		  <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
		  <li><a href="{{ URL::route('admin.company.view', $company->id) }}">{{ $company->name }}</a></li>
		  <li class="active">Attachments</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => array('admin.company.attachments',$company->id ),
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter attachments ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			@if(can('attachment.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.company.attachment.add', $company->id) }}" title="Add new attachment"><span class="glyphicon glyphicon-plus-sign"></span> Add new attachment</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Attachments per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 Attachments</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 Attachments</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 Attachments</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 Attachments</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 Attachments</a></li>
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

					<th width="60%"><a href="{{ query_url(URL::current(), array('col' => 'name', 'order' => 
						( Input::get('col') == 'name' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="name">Name <span class="glyphicon order-arrow {{ Input::get('col') == 'name' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15%"><a href="{{ query_url(URL::current(), array('col' => 'access', 'order' => 
						( Input::get('col') == 'access' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="name">Access <span class="glyphicon order-arrow {{ Input::get('col') == 'access' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					@if(can('attachment.view'))
						<td width="15"><span class="glyphicon glyphicon-download"></span></td>
					@endif
					@if(can('attachment.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('attachment.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($attachments) > 0)
					@foreach($attachments as $attachment)
						<tr>
							<td>{{ $attachment->id }}</td>
							<td>{{ $attachment->name }}</td>
							<td>{{ $attachment->type }}</td>
							<td>{{ $attachment->access }}</td>
							@if(can('attachment.view'))
								<td><a href="{{ asset($attachment->getFullPath()) }}" target="_blank" title="Download File"><span class="glyphicon glyphicon-download"></span></a></td>
							@endif
							@if(can('attachment.edit'))
								<td><a href="{{ URL::route('admin.company.attachment.edit', array('company_id' => $attachment->company_id,'id'=> $attachment->id)) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif
							@if(can('attachment.delete'))
								<td><a href="{{ URL::route('admin.company.attachment.delete', array('company_id' => $attachment->company_id,'id'=> $attachment->id)) }}" title="Delete" class="confirm-action" data-name="{{ $attachment->name }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="7" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $attachments->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop