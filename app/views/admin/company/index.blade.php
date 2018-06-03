@extends('layouts.admin')

@section('title')
	Admin Companies
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
		  <li class="active">Companies</li>
		</ol>

		<nav class="navbar navbar-default actions">
			{{ Form::open(array('route' => 'admin.companies',
								'method' => 'get',
								'class' => 'navbar-form navbar-right')) }}
				<div class="form-group">
					{{ Form::text('search', Input::get('search'), array('class' => 'form-control', 'placeholder' => 'Filter Companies ...')) }}
				</div>
				{{ Form::submit('search', array('class' => 'btn btn-primary')) }}
				{{ Form::hidden('approved', Input::get('approved')) }}
				{{ Form::hidden('rows', Input::get('rows')) }}
				{{ Form::hidden('col', Input::get('col')) }}
				{{ Form::hidden('order', Input::get('order')) }}
				<a href="{{ URL::current() }}" title="Clear search data" class="btn btn-default">Clear</a>
			{{ Form::close() }}
			
			@if(can('company.add'))
				<nav class="navbar navbar-nav navbar-left">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus-sign"></span> Add Company <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ URL::route('admin.company.add', 'pe') }}" title="Add new company">Add PE company</a></li>
					          <li><a href="{{ URL::route('admin.company.add', 'vc') }}" title="Add new company">Add VC company</a></li>
					          <li><a href="{{ URL::route('admin.company.add', 're') }}" title="Add new company">Add RE company</a></li>
	        				</ul>
						</li>
						<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('rows')) ? Input::get('rows') : Config::get('ilosool.rows_default') }} Companies per page <b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('rows' => '10'))}}">10 companies</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '20'))}}">20 companies</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '30'))}}">30 companies</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '40'))}}">40 companies</a></li>
					          <li><a href="{{ query_url(URL::current(), array('rows' => '50'))}}">50 companies</a></li>
	        				</ul>
     				 	</li>
     				 	<li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> {{ (Input::get('approved')) ? ucfirst(Input::get('approved')) : ' Approved ' }}<b class="caret"></b></a>
					        <ul class="dropdown-menu">
					          <li><a href="{{ query_url(URL::current(), array('approved' => 'approved'))}}">Approved</a></li>
					          <li><a href="{{ query_url(URL::current(), array('approved' => 'unapproved'))}}">Unapproved</a></li>
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

					<th width="30%"><a href="{{ query_url(URL::current(), array('col' => 'name', 'order' => 
						( Input::get('col') == 'name' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="name">Deal Name <span class="glyphicon order-arrow {{ Input::get('col') == 'name' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="15%"><a href="{{ query_url(URL::current(), array('col' => 'fancyname', 'order' => 
						( Input::get('col') == 'fancyname' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="fancyname">Fancy name <span class="glyphicon order-arrow {{ Input::get('col') == 'fancyname' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th width="10%"><a href="{{ query_url(URL::current(), array('col' => 'country', 'order' => 
						( Input::get('col') == 'country' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="country">Country <span class="glyphicon order-arrow {{ Input::get('col') == 'country' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th class="text-center" width="10%"><a href="{{ query_url(URL::current(), array('col' => 'type', 'order' => 
						( Input::get('col') == 'type' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="type">Type <span class="glyphicon order-arrow {{ Input::get('col') == 'type' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th class="text-center" width="10%"><a href="{{ query_url(URL::current(), array('col' => 'featured', 'order' => 
						( Input::get('col') == 'featured' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="featured">Featured <span class="glyphicon order-arrow {{ Input::get('col') == 'featured' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th class="text-center" width="10%"><a href="{{ query_url(URL::current(), array('col' => 'status', 'order' => 
						( Input::get('col') == 'status' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="status">Status <span class="glyphicon order-arrow {{ Input::get('col') == 'status' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>

					<th class="text-center" width="15%"><a href="{{ query_url(URL::current(), array('col' => 'approved', 'order' => 
						( Input::get('col') == 'approved' ? ((Input::get('order') == 'ASC' ) ? 'DESC' : 'ASC') : 'ASC' )
					)) }}" name="approved">Approved <span class="glyphicon order-arrow {{ Input::get('col') == 'approved' ? (strtolower(Input::get('order')) == 'asc' ? 'asc' : 'desc') : '' }}"></span></a></th>
					@if(can('investment.view'))
						<th width="15"><span class="glyphicon glyphicon-usd action"></span></th>
					@endif
					@if(can('attachment.view'))
						<th width="15"><span class="glyphicon glyphicon-cloud-download action"></span></th>
					@endif
					@if(can('staff.view'))
						<th width="15"><span class="glyphicon glyphicon-user action"></span></th>
					@endif
					<th width="15"><span class="glyphicon glyphicon-eye-open action"></span></th>
					@if(can('company.edit'))
						<th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
					@endif
					@if(can('company.delete'))
						<th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
					@endif
					@if(can('company.delete'))
						<th width="15"><span class="glyphicon glyphicon-record action"></span></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if(count($companies) > 0)
					@foreach($companies as $company)
						@if (!$company->trashed())
							<tr>
								<td>{{ $company->id }}</td>
								<td>{{ $company->deal_name }}</td>
								<td>{{ $company->fancyname }}</td>
								<td>{{ $company->country }}</td>
								<td class="text-center">{{ $company->type }}</td>
								<td class="text-center">
									@if($company->featured == "1")
										<a href="{{ URL::route('admin.company.featured', array($company->id, 0)) }}" title="Featured"><span class="glyphicon glyphicon-star action"></span></a>
									@else
										<a href="{{ URL::route('admin.company.featured', array($company->id, 1)) }}" title="Unfeatured"><span class="glyphicon glyphicon-star action unapproved"></span></a>
									@endif
								</td>
								<td class="text-center">
									@if($company->status == "published")
										<a href="{{ URL::route('admin.company.status', array($company->id, 'unpublish')) }}" title="Published" class="confirm-action" data-name="{{ $company->name }}" data-action="unpublish"><span class="glyphicon glyphicon-bullhorn action"></span></a>
									@else
										<a href="{{ URL::route('admin.company.status', array($company->id, 'publish')) }}" title="Unpublished" title="Published" class="confirm-action" data-name="{{ $company->name }}" data-action="publish"><span class="glyphicon glyphicon-bullhorn action unapproved"></span></a>
									@endif
								</td>
								<td class="text-center">
									@if($company->approved == 0 )
										<a href="{{ URL::route('admin.company.approve',array($company->id, 'approve')) }}" title="Unapproved" class="confirm-action" data-name="{{ $company->name }}" data-action="approve"><span class="glyphicon glyphicon-ok-sign action unapproved" ></span></a>
									@else
										<a href="{{ URL::route('admin.company.approve', array($company->id, 'unapprove')) }}" title="Approved" class="confirm-action" data-name="{{ $company->name }}" data-action="unapprove"><span class="glyphicon glyphicon-ok-sign action"></span></a>
									@endif
								</td>
								@if(can('investment.view'))
									<td><a href="{{ URL::route('admin.company.investments', $company->id) }}" title="View Investments"><span class="glyphicon glyphicon-usd action"></span></a></td>
								@endif
								@if(can('attachment.view'))
									<td><a href="{{ URL::route('admin.company.attachments', $company->id) }}" title="View Attachments"><span class="glyphicon glyphicon-cloud-download action"></span></a></td>
								@endif
								@if(can('staff.view'))
									<td><a href="{{ URL::route('admin.company.staff', $company->id) }}" title="View Staff"><span class="glyphicon glyphicon-user action"></span></a></td>
								@endif
								<td><a href="{{ URL::route('admin.company.view', $company->id) }}" title="View"><span class="glyphicon glyphicon-eye-open action"></span></a></span></a></td>
								@if(can('company.edit'))
									<td><a href="{{ URL::route('admin.company.edit', $company->id) }}" title="Edit"><span class="glyphicon glyphicon-edit action"></span></a></td>
								@endif
								@if(can('company.delete'))
									<td><a href="{{ URL::route('admin.company.delete', $company->id) }}" title="Delete" class="confirm-action" data-name="{{ $company->deal_name }}"><span class="glyphicon glyphicon-trash action"></span></a></td>
								@endif
								@if(can('company.edit'))
									<td class="text-center">
										@if($company->trashed())
											<a href="{{ URL::route('admin.company.trash', array($company->id, 'untrash')) }}" title="Untrash" class="confirm-action" data-name="{{ $company->name }}" data-action="untrash"><span class="glyphicon glyphicon-record action"></span></a>
										@else
											<a href="{{ URL::route('admin.company.trash', array($company->id, 'trash')) }}" title="Trash" class="confirm-action" data-name="{{ $company->name }}" data-action="trash"><span class="glyphicon glyphicon-record action unapproved"></span></a>
											
										@endif
									</td>
								@endif
							</tr>
						@else
							<tr class="{{ $company->trashed() ? 'danger' : '' }}">
								<td>{{ $company->id }}</td>
								<td>{{ $company->name }}</td>
								<td>{{ $company->fancyname }}</td>
								<td>{{ $company->country }}</td>
								<td class="text-center">{{ $company->type }}</td>
								<td class="text-center">
									<span class="glyphicon glyphicon-star"></span>
								</td>
								<td class="text-center">
									<span class="glyphicon glyphicon-bullhorn"></span>
								</td>
								<td class="text-center">
									<span class="glyphicon glyphicon-ok-sign" ></span>
								</td>
								@if(can('investment.view'))
									<td><span class="glyphicon glyphicon-usd action"></span></td>
								@endif
								@if(can('attachment.view'))
									<td><span class="glyphicon glyphicon-cloud-download"></span></td>
								@endif
								@if(can('staff.view'))
									<td><span class="glyphicon glyphicon-user"></span></td>
								@endif
								<td><span class="glyphicon glyphicon-eye-open"></span></td>
								@if(can('company.edit'))
									<td><span class="glyphicon glyphicon-edit"></span></td>
								@endif
								@if(can('company.delete'))
									<td><span class="glyphicon glyphicon-trash"></span></td>
								@endif
								@if(can('company.edit'))
									<td class="text-center">
										@if($company->trashed())
											<a href="{{ URL::route('admin.company.trash', array($company->id, 'untrash')) }}" title="Untrash" class="confirm-action" data-name="{{ $company->name }}" data-action="untrash"><span class="glyphicon glyphicon-record action"></span></a>
										@else
											<a href="{{ URL::route('admin.company.trash', array($company->id, 'trash')) }}" title="Trash"><span class="glyphicon glyphicon-record action unapproved"></span></a>
											
										@endif
									</td>
								@endif
							</tr>
						@endif
					@endforeach
				@else
					<tr><td colspan="12" class="empty">No Result found</td></tr>
				@endif
			</tbody>
		</table>
		<div style="text-align:center">
	    	{{ $companies->appends(array('search' => Input::get('search'), 'col' => Input::get('col') , 'order' => Input::get('order'), 'rows' => Input::get('rows'), 'approved' => Input::get('approved') ))->links(array('class' => 'pagination')) }}
	    </div>
	</div>
@stop