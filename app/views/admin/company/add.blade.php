@extends('layouts.admin')

@section('title')
  Admin Company Add
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
          <li class="active">Add New Company</li>
        </ol>
    @if($type == 'pe')
        {{ Form::open(array('route' => 'admin.company.pe.add.post','files' => true, 'class' => 'form-horizontal')) }}
            @include('admin.company.pe_form')
        {{ Form::close() }}
    @elseif ($type == 'vc')
        {{ Form::open(array('route' => 'admin.company.vc.add.post','files' => true, 'class' => 'form-horizontal')) }}
            @include('admin.company.vc_form')
        {{ Form::close() }}
    @elseif ($type == 're')
        {{ Form::open(array('route' => 'admin.company.re.add.post','files' => true, 'class' => 'form-horizontal')) }}
            @include('admin.company.re_form')
        {{ Form::close() }}
    @endif
    </div>
@stop