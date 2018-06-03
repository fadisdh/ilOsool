@extends('layouts.admin')

@section('title')
  Admin Vouchers
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
		  <li class="active">Vouchers</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => 'admin.vouchers',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Vouchers ...')) }}
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
			@if(can('voucher.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li>
							<a href="{{ URL::route('admin.voucher.add') }}" title="Add new voucher"><span class="glyphicon glyphicon-plus-sign"></span> Add new voucher</a>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Vouchers per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 vouchers</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 vouchers</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 vouchers</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 vouchers</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 vouchers</a></li>
	        				</ul>
     				 	</li>	
					</ul>
				</nav>
			@endif
		</nav>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="5%"><a href="{{ query_url(URL::current(), array('col' => 'id', 'order' => 
						( Input::get('col') == 'id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title"># <span class="glyphicon order-arrow {{ Input::get('col') == 'id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'user', 'order' => 
						( Input::get('col') == 'user' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">User <span class="glyphicon order-arrow {{ Input::get('col') == 'user' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="25%"><a href="{{ query_url(URL::current(), array('col' => 'company', 'order' => 
						( Input::get('col') == 'company' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' ) 
					)) }}" name="title">Company <span class="glyphicon order-arrow {{ Input::get('col') == 'company' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					
					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'start_date', 'order' => 
						( Input::get('col') == 'start_date' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">Start Date <span class="glyphicon order-arrow {{ Input::get('col') == 'start_date' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'end_date', 'order' => 
						( Input::get('col') == 'end_date' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="title">End Date <span class="glyphicon order-arrow {{ Input::get('col') == 'end_date' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('voucher.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('voucher.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($vouchers) > 0)
					@foreach($vouchers as $voucher)
						<tr>
							<td>{{ $voucher->id }}</td>
							<td>{{ $voucher->user->firstname . ' ' . $voucher->user->lastname}}</td>
							<td>{{ $voucher->company->name }}</td>
							<td>{{ $voucher->type }}</td>
							<td>{{ $voucher->start_date }}</td>
							<td>{{ $voucher->end_date }}</td>

							<td><a href="{{ URL::route('admin.voucher.view', $voucher->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('voucher.edit'))
								<td><a href="{{ URL::route('admin.voucher.edit', $voucher->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif
							@if(can('voucher.delete'))
								<td><a href="{{ URL::route('admin.voucher.delete', $voucher->id) }}" title="Delete" class="confirm-action" data-name="{{ $voucher->id }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
				
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $vouchers->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop