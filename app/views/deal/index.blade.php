@extends('layouts.master')

@section('title')
  Deals
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

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => array('deals', $id),
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', null, array('class' => 'form-control', 'placeholder' => 'Filter Deals ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				<a href="{{ query_url(URL::current(), array('search' => null)  ) }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
						</li>
					</ul>
				</nav>
			@if(can('deal.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('deal.add', $id ) }}" title="Add new deal"><span class="glyphicon glyphicon-plus-sign"></span> Add new deal</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Deal per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 deals</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 deals</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 deals</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 deals</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 deals</a></li>
	        				</ul>
     				 	</li>
					</ul>
				</nav>
				
			@endif
		</nav>
		
		<table class="table">
			<thead>
				<tr>
					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'id', 'order' => 
						( Input::get('col') == 'id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="50%"><a href="{{ query_url(URL::current(), array('col' => 'title', 'order' => 
						( Input::get('col') == 'title' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Title <span class="glyphicon order-arrow {{ Input::get('col') == 'title' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="40%"><a href="{{ query_url(URL::current(), array('col' => 'brief', 'order' => 
						( Input::get('col') == 'brief' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="brief">Brief <span class="glyphicon order-arrow {{ Input::get('col') == 'brief' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('deal.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('deal.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($deals as $deal)
					<tr>
						<td>{{ $deal->id }}</td>
						<td>{{ $deal->title }}</td>
						<td>{{ $deal->brief }}</td>

						<td><a href="{{ URL::route('deal.view', array($id, $deal->id)) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
						@if(can('deal.edit'))
							<td><a href="{{ URL::route('deal.edit', array($id, $deal->id)) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
						@endif
						@if(can('deal.delete'))
							<td><a href="{{ URL::route('deal.delete', array($id, $deal->id)) }}" title="Delete"><span class="glyphicon glyphicon-trash action"></span></a></td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>

		<div style="text-align:center">
	    	{{ $deals->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	    
	</div>
@stop