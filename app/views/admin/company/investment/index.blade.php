@extends('layouts.admin')

@section('title')
	Admin Investments
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
		  <li class="active">Investments</li>
		</ol>

		<nav class="navbar navbar-default actions">
			
			{{ Form::open(array('route' => array('admin.company.investments', $company->id ),
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Investments ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			<nav class="navbar navbar-nav navbar-left">
				<ul class="nav navbar-nav">
					@if(can('investment.add'))
						<li>
							<a href="{{ URL::route('admin.company.investment.add', $company->id) }}" title="Add new investment member"><span class="glyphicon glyphicon-plus-sign"></span> Add new investment</a>
						</li>
					@endif
					<li class="dropdown">
				        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Investment per page <b class="caret"></b></a>
				        <ul class="dropdown-menu">
				          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 Investment</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 Investment</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 Investment</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 Investment</a></li>
				          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 Investment</a></li>
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

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'amount', 'order' => 
						( Input::get('col') == 'amount' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="amount">Amount <span class="glyphicon order-arrow {{ Input::get('col') == 'amount' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'value', 'order' => 
						( Input::get('col') == 'value' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="value">Value <span class="glyphicon order-arrow {{ Input::get('col') == 'value' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="20%"><a href="{{ query_url(URL::current(), array('col' => 'user_id', 'order' => 
						( Input::get('col') == 'user_id' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="investor">Investor <span class="glyphicon order-arrow {{ Input::get('col') == 'user_id' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'status', 'order' => 
						( Input::get('col') == 'status' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="status">Status <span class="glyphicon order-arrow {{ Input::get('col') == 'status' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('investment.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('investment.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($investments) > 0)
					@foreach($investments as $invst)
						<tr>
							<td>{{ $invst->id }}</td>
							<td>{{ $invst->amount }}</td>
							<td>{{ $invst->value }}</td>
							<td>{{ $invst->user_id }}</td>
							<td>{{ $invst->status }}</td>
							<td><a href="{{ URL::route('admin.company.investment.view', array('company_id' => $invst->company_id,'id'=> $invst->id)) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
							@if(can('investment.edit'))
								<td><a href="{{ URL::route('admin.company.investment.edit', array('company_id' => $invst->company_id,'id'=> $invst->id)) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
							@endif
							@if(can('investment.delete'))
								<td><a href="{{ URL::route('admin.company.investment.delete', array('company_id' => $invst->company_id,'id'=> $invst->id)) }}" title="Delete" class="confirm-action" data-name="investment {{ $invst->id }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
							@endif
						</tr>
					@endforeach
				@else
					<tr><td colspan="6" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $investments->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop