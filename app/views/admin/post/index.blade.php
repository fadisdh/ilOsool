@extends('layouts.admin')

@section('title')
  Admin Posts
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
		  <li class="active">Posts</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.posts',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Posts ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('type', Input::get('type')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			<nav class="navbar navbar-nav navbar-left">
				<ul class="nav navbar-nav">
					@if(can('post.add'))
						<li>
							<a href="{{ URL::route('admin.post.add') }}" title="Add new post"><span class="glyphicon glyphicon-plus-sign"></span> Add new post</a>
						</li>
					@endif
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Posts per page <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 posts</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 posts</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 posts</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 posts</a></li>
							<li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 posts</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> Posts by type<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<?php 
								$types = Config::get('ilosool.post_types');
							?>
							@foreach($types as $key)
								<li><a href="{{ query_url(URL::current(), array('type' => strtolower($key)) )}}">{{ $key }}</a></li>
							@endforeach
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

	                <th width="50%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('post.edit'))
	                	<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
	                @endif
	                @if(can('post.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
	            </tr>
	        </thead>
			<tbody>
				@if(count($posts) > 0)
			        @foreach($posts as $post)
			            <tr>  
				            <td>{{ $post->id }}</td>
				            <td>{{ trimWords($post->title, 10) }}</td>
				            <td>{{ $post->type }}</td>

				            <td><a href="{{ URL::route('admin.post.view', $post->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
				            @if(can('post.edit'))
		 						<td><a href="{{ URL::route('admin.post.edit', $post->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
		 					 @endif
		 					@if(can('post.delete'))
								<td><a href="{{ URL::route('admin.post.delete', $post->id) }}" title="Delete" class="confirm-action" data-name="{{ trimWords($post->title, 10) }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
			            </tr>
				    @endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
	    <div style="text-align:center">
	    	{{ $posts->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows'), 'type' => Input::get('type') ))->links(array('class' => 'pagination')) }}
	    </div>
		
	   
	</div>
@stop