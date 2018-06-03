@extends('layouts.admin')

@section('title')
  Admin Rule View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.rules') }}">Rules</a></li>
		  <li class="active">{{ $rule->name }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.rule.edit', $rule->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $rule->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Name</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $rule->name }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Permissions</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">
		    	<?php $title_tmp = ''; ?>
	    		@foreach ($rule->permissions as $key => $val)
		            <?php   
		                $rule_title = explode( '.' , $val );
		                if($rule_title[0] ==  $title_tmp){
		                  $block_title = false;  
		                }else{
		                  $block_title = true;  
		                }
		                $title_tmp = $rule_title[0];
		            ?>
		            @if($block_title)	
		                <h4>{{ ucfirst($rule_title[0]) }}</h4>
		            @endif
		            {{ ucfirst($rule_title[1]) }}
		    	@endforeach
		    </div>
		</div>
	</div>
@stop