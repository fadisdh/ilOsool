@extends('layouts.admin')

@section('title')
  Admin Voucher Add
@stop

@section('scripts')
    @parent
    {{ HTML::style('js/autocomplete/token-input.css') }}
    {{ HTML::style('js/autocomplete/autocomplete.css') }}
    {{ HTML::script('js/autocomplete/jquery.tokeninput.js') }}

    <script type="text/javascript">
        $(document).ready(function() {
            var $user_autocomplete = $("#user_autocomplete");
            var user_id = $user_autocomplete.attr('data-id');
            var user_name = $user_autocomplete.attr('data-name');
            $user_autocomplete.tokenInput("{{ URL::route('admin.users.autocomplete', array('type' => 'id')) }}",{
                theme: "facebook", minChars: 2, resultsLimit: 10, tokenLimit: 1});

            $('.token-input-dropdown-facebook').width($user_autocomplete.width() - 10 );
            if(user_id && user_name) $user_autocomplete.tokenInput("add", {id: user_id, name: user_name});


            var $company_autocomplete = $("#company_autocomplete");
            var company_id = $company_autocomplete.attr('data-id');
            var company_name = $company_autocomplete.attr('data-name');
            $company_autocomplete.tokenInput("{{ URL::route('admin.companies.autocomplete', array('type' => 'id')) }}",{
                theme: "facebook", minChars: 2, resultsLimit: 10, tokenLimit: 1});

            $('.token-input-dropdown-facebook').width($company_autocomplete.width() - 10 );
            if(company_id && company_name) $company_autocomplete.tokenInput("add", {id: company_id, name: company_name});
        });
    </script>
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
        	<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
        	<li><a href="{{ URL::route('admin.vouchers') }}">Vouchers</a></li>
        	<li class="active">Add New Voucher</li>
        </ol>
        {{ Form::open(array('route' => 'admin.voucher.add', 
                            'class' => 'form-horizontal',
                            'files' => true)) }}
            @include('admin.voucher.form')
        {{ Form::close() }}
    </div>
@stop