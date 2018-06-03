@extends('layouts.admin')

@section('title')
  Admin Rules
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
		  <li class="active">Rules</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.rules',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter rules ...')) }}
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
			@if(can('rule.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.rule.add') }}" title="Add new rule"><span class="glyphicon glyphicon-plus-sign"></span> Add new rule</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Rules per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="#">10 rules</a></li>
					          <li><a href="#">20 rules</a></li>
					          <li><a href="#">30 rules</a></li>
					          <li><a href="#">40 rules</a></li>
					          <li><a href="#">50 rules</a></li>
	        				</ul>
     				 	</li>
					</ul>
				</nav>
				
			@endif
		</nav>

		<table class="table table-striped table-hover ">
			<thead>
				<tr>
					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'id', 'order' => 
						( Input::get('col') == 'id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="90%"><a href="{{ query_url(URL::current(), array('col' => 'name', 'order' => 
						( Input::get('col') == 'name' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="name">Name <span class="glyphicon order-arrow {{ Input::get('col') == 'name' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					
					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('rule.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif

					@if(can('rule.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($rules) > 0)
					@foreach($rules as $rule)
						<tr>
							<td>{{ $rule->id }}</td>
							<td>{{ $rule->name }}</td>

							<td><a href="{{ URL::route('admin.rule.view', $rule->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('rule.edit'))
								<td><a href="{{ URL::route('admin.rule.edit', $rule->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif
							@if(can('rule.delete'))
								<td><a href="{{ URL::route('admin.rule.delete', $rule->id) }}" title="Delete" class="confirm-action" data-name="{{ $rule->name }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif	
						</tr>
					@endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $rules->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop