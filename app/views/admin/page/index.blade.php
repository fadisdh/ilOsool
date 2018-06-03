@extends('layouts.admin')

@section('title')
  Admin Pages
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
		  <li class="active">Pages</li>
		</ol>
		
		<nav class="navbar navbar-default actions">
			{{ Form::open(array('route' => 'admin.pages',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Pages ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			@if(can('page.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.page.add') }}" title="Add new page"><span class="glyphicon glyphicon-plus-sign"></span> Add new page</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Pages per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 pages</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 pages</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 pages</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 pages</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 pages</a></li>
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

					<th width="40%"><a href="{{ query_url(URL::current(), array('col' => 'slug', 'order' => ( Input::get('col') == 'slug' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="slug">Slug <span class="glyphicon order-arrow {{ Input::get('col') == 'slug' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('page.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('page.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($pages) > 0)
					@foreach($pages as $page)
						<tr>
							<td>{{ $page->id }}</td>
							<td>{{ $page->title }}</td>
							<td>{{ $page->slug }}</td>

							<td><a href="{{ URL::route('admin.page.view', $page->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('page.edit'))
								<td><a href="{{ URL::route('admin.page.edit', $page->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif
							@if(can('page.delete'))
								<td><a href="{{ URL::route('admin.page.delete', $page->id) }}" title="Delete" class="confirm-action" data-name="{{ $page->title }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $pages->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop