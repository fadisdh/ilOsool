@extends('layouts.site')

@section('title')
  Listing Attachments
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">

                @include('profile.topmenu')
                <div class="container company-edit-form">
                    <div class="row clearfix">
                        <div class="col-md-9">
                            <h2 class="page-title">{{trans('deal.attachments_of')}} {{ $company->name }}</h2>
                        </div>
                        <div class="col-md-3 addcompany-btn">
                            <a href="{{URL::route('attachment.add', $company->id)}}" class="btn btn-primary" title="Add New Company">{{trans('deal.add_new_attachment')}}</a>
                        </div>
                    </div>
                    
                    @if(Session::has('action'))
                        <div class="alert company-form-alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
                            {{ Session::get('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="30%">{{trans('deal.name')}}</th>

                                <th width="25%">{{trans('deal.access')}}</th>

                                <th width="35%">{{trans('deal.download')}}</th>
                                
                                <th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
                                
                                <th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($company->attachments) > 0)
                                @foreach($company->attachments as $a)
                                        <tr>
                                            <td>{{ $a->name }}</td>
                                            <td>{{ trans('general.'.$a->access) }}</td>
                                            <td><a href="{{ asset($a->getFullPath()) }}" target="_blank" class="label label-default"><span class="glyphicon glyphicon-download"></span> {{ $a->url }}</a></td>
                                            
                                            <td><a href="{{URL::route('attachment.edit', $a->id)}}" title="Edit Attachment"><span class="glyphicon glyphicon-edit action"></span></a></td>

                                            <td><a href="{{URL::route('attachment.delete', $a->id)}}" title="Delete" class="confirm-action" data-name="{{ $a->name }}" data-action="trash"><span class="glyphicon glyphicon-trash action unapproved"></span></a></td>          
                                        </tr>
                                @endforeach
                            @else
                                <tr><td colspan="12" class="empty">{{trans('deal.no_attachments')}}</td></tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>  
    </div>
@stop