<div id="requestfiles-res">
    
        {{ Form::model($company, array('route' => array('company.update_investment.post', $company->id),
                                        'class' => 'form-horizontal ajax',
                                        'data-res' => '#requestfiles-res')) }}
    <div class="modal-body popup-bookmarks-body">
        <div class="form-group {{ (isset($error)) ? 'has-error' : '' }}">
            {{ Form::label('current', trans('deal.current_amount'), array('class' => 'control-label col-md-4')) }}
            <div class="input-group col-md-8">
                {{ Form::text('current', (isset($old)) ? $old : null, array('class' => 'form-control')) }}
                <span class="input-group-addon">{{$company->target_suffix}}</span>
            </div>
                
            @if(isset($error))
            <div class="col-md-8 col-md-offset-4">
                <div class="help-block">{{trans('validation.custom.correct_value')}}</div>
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer popup-bookmarks-footer">
        {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary ajax')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
    </div>
    {{ Form::token(); }}
    {{ Form::close() }}
</div>