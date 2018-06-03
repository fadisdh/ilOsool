@extends('layouts.admin')

@section('title')
  Admin Company Edit
@stop

@section('scripts')
    @parent
    {{ HTML::style('js/autocomplete/token-input.css') }}
    {{ HTML::style('js/autocomplete/autocomplete.css') }}
    {{ HTML::script('js/autocomplete/jquery.tokeninput.js') }}

    <script type="text/javascript">
        $(document).ready(function() {
            var $autocomplete = $("#autocomplete");
            var id = $autocomplete.attr('data-id');
            var name = $autocomplete.attr('data-name');
            $autocomplete.tokenInput("{{ URL::route('admin.users.autocomplete', array('type' => 'id')) }}",{
                theme: "facebook", minChars: 2, resultsLimit: 10, tokenLimit: 1});

            $('.token-input-dropdown-facebook').width($autocomplete.width() - 10 );
            if(id && name) $autocomplete.tokenInput("add", {id: id, name: name});
        });
    </script>
@stop

@section('content')
    @parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $company->id) }}">{{ $company->name }}</a></li>
           <li class="active">Edit</li>
        </ol>
        @if($company->type == 'pe')
          {{ Form::model($company, array('route' => array('admin.company.pe.edit.post', $company->id),
                                        'class' => 'form-horizontal',
                                        'files' => true)) }}
              @include('admin.company.pe_form')
          {{ Form::close() }}
        @elseif($company->type == 'vc')
          {{ Form::model($company, array('route' => array('admin.company.vc.edit.post', $company->id),
                                        'class' => 'form-horizontal',
                                        'files' => true)) }}
              @include('admin.company.vc_form')
          {{ Form::close() }}
        @elseif($company->type == 're')
          {{ Form::model($company, array('route' => array('admin.company.re.edit.post', $company->id),
                                        'class' => 'form-horizontal',
                                        'files' => true)) }}
              @include('admin.company.re_form')
          {{ Form::close() }}
        @endif
    </div>
@stop