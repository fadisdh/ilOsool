@extends('layouts.site')

@section('title')
  Listing Staff
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
                            <h2 class="page-title">{{trans('deal.staff_of')}} {{ $company->name }}</h2>
                        </div>
                        <div class="col-md-3 addcompany-btn">
                            <a href="{{URL::route('staff.add', $company->id)}}" class="btn btn-primary" title="Add New Company">{{trans('deal.add_new_staff')}}</a>
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
                                <th width="35%">{{trans('deal.name')}}</th>
                                <th width="35%">{{trans('deal.position')}}</th>
                                <th width="15%">{{trans('deal.type')}}</th>
                                <th width="15%">{{trans('deal.access')}}</th>
                                
                                <th width="15"><span class="glyphicon glyphicon-edit action"></span></th>
                                
                                <th width="15"><span class="glyphicon glyphicon-trash action"></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($company->staff) > 0)
                                @foreach($company->staff as $s)
                                        <tr>
                                            <td>{{ $s->name }}</td>
                                            <td>{{ $s->position }}</td>
                                            <td>{{ $s->type }}</td>
                                            <td>{{ $s->access }}</td>
                                            
                                            <td><a href="{{ URL::route('staff.edit', array($company->id, $s->id) ) }}" title="Edit Staff"><span class="glyphicon glyphicon-edit action"></span></a></td>

                                            <td><a href="{{URL::route('staff.delete', $s->id)}}" title="Delete" class="confirm-action" data-name="{{ $s->name }}" data-action="trash"><span class="glyphicon glyphicon-trash action unapproved"></span></a></td>          
                                        </tr>
                                @endforeach
                            @else
                                <tr><td colspan="12" class="empty">{{trans('deal.no_staff')}}</td></tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>  
    </div>
@stop