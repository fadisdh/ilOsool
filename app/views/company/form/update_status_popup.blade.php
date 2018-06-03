<div id="requestfiles-res">
        {{ Form::model($company, array('route' => array('company.update_status.post', $company->id),
                                        'class' => 'form-horizontal ajax',
                                        'data-res' => '#requestfiles-res')) }}
    <div class="modal-body popup-bookmarks-body">
        <div class="form-group">
            
            {{ Form::label('name', trans('deal.listing_status') , array('class' => 'control-label col-md-2')) }}
            <div class="input-group col-md-8">
                @if(getLocale() == 'ar')
                    {{ Form::select('status', Config::get('ilosool.listing_status_arabic'), null, array('class' => 'form-control')) }}
                @else
                    {{ Form::select('status', Config::get('ilosool.listing_status'), null, array('class' => 'form-control')) }}
                @endif
            </div>
        </div>
    </div>
    <div class="modal-footer popup-bookmarks-footer">
        {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary ajax')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
    </div>
    {{ Form::token() }}
    {{ Form::close() }}
</div>