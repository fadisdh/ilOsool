@extends('layouts.popup')

@section('body_class')
  	popup-delete-body
@stop

@section('body')
  	<div>{{trans('deal.bookmark_delete_confirm')}}</div>
@stop

@section('footer')
	<a class="btn btn-danger popup" href="{{URL::route('bookmark.delete.popup', $bookmarkId) }}" data-refresh="true" title="Delete">{{trans('general.confirm')}}</a>
  	<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
@stop