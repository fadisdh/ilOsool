<div id="requestfiles-res">
    @if(isset($folder) && $folder->id == 0)
        {{ Form::open(array('route' => array('profile.folder.action.post', 'add', $folder->id),
                            'class' => 'form-horizontal ajax',
                            'data-res' => '#requestfiles-res')) }}
    @else
        {{ Form::model($folder, array('route' => array('profile.folder.action.post', 'edit',  $folder->id),
                                        'class' => 'form-horizontal ajax',
                                        'data-res' => '#requestfiles-res')) }}
    @endif
    <div class="modal-body popup-bookmarks-body">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
            {{ Form::label('name', trans('general.name') , array('class' => 'control-label col-md-2')) }}
            <div class="col-md-9">
                {{ Form::text('name', null, array('class' => 'form-control', 'placeholder' => trans('profile.my_bookmarks.folder_placeholder') )) }}
            </div>
            <div class="col-md-9 col-md-offset-2">
                <div class="help-block">{{ $errors->first('name') }}</div>
            </div>
        </div>
    </div>
    <div class="modal-footer popup-bookmarks-footer">
        {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary ajax')) }}
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
    </div>
    {{ Form::token(); }}
    {{ Form::close() }}
</div>