@extends('layouts.admin')

@section('title')
  Admin Newsletters
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
		  <li class="active">Newsletters</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.newsletters',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter newsletters ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
						</li>
					</ul>
				</nav>
			@if(can('newsletter.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.newsletter.add') }}" title="Add new newsletter"><span class="glyphicon glyphicon-plus-sign"></span> Add new newsletter</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} newsletters per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 newsletter</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 newsletter</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 newsletter</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 newsletter</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 newsletter</a></li>
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

					<th width="50%"><a href="{{ query_url(URL::current(), array('col' => 'title', 'order' => 
						( Input::get('col') == 'title' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Title <span class="glyphicon order-arrow {{ Input::get('col') == 'title' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="40%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					@if(can('newsletter.use'))
						<th width="15"><span class="glyphicon glyphicon-envelope action"></span></th>
					@endif
					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('newsletter.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif

					@if(can('newsletter.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($newsletters) > 0)
					@foreach($newsletters as $newsletter)
						<tr>
							<td>{{ $newsletter->id }}</td>
							<td>{{ $newsletter->title }}</td>
							<td>{{ $newsletter->type }}</td>
							@if(can('newsletter.use'))
								<th width="15"><a href="{{ URL::route('admin.newsletter.use', $newsletter->id) }}" title="Use"><span class="glyphicon glyphicon-envelope action"></span></a></th>
							@endif
							<td><a href="{{ URL::route('admin.newsletter.view', $newsletter->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('newsletter.edit'))
								<td><a href="{{ URL::route('admin.newsletter.edit', $newsletter->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif	
							@if(can('newsletter.delete'))
								<td><a href="{{ URL::route('admin.newsletter.delete', $newsletter->id) }}" title="Delete" class="confirm-action" data-name="{{ $newsletter->title }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="7" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $newsletters->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop