@extends('layouts.popup')

@section('body_class')
  	popup-delete-body
@stop

@section('body')
  	<div> {{trans('profile.my_bookmarks.remove_folder_info')}}<strong> {{ $folder->name }}</strong>.</div>
@stop

@section('footer')
	<a class="btn btn-danger popup" href="{{URL::route('profile.folder.delete', $folder->id) }}" data-refresh="true" title="{{trans('general.confirm')}}">{{trans('general.confirm')}}</a>
  	<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
@stop
