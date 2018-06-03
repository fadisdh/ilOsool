<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
</div>

<div class="form-group">
{{ Form::label('permissions[]', 'Permissions', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        <table class="table table-striped table-hover ">
            <tbody>
                @foreach($pers as $key => $val)
                    <tr>
                        <td width="20%">{{ $key }}</td>
                        @foreach($val as $key2 => $val2)
                            <td>{{ Form::checkbox('permissions[]', $val2, null, array('id' => $val2)) }}
                                {{ Form::label($val2, $key2) }}</td>
                        @endforeach
                        <?php $count = count($val); ?>
                        @if($count < 6)
                            <td colspan="{{ 6 - count($val) }}"></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.rules') }}" class="btn btn-default">Cancel</a>
    </div>
</div>

{{ Form::token(); }}