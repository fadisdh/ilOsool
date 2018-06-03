<div class="row">
    <div class="complete-reg-container col-md-8 col-md-offset-2">
        <p class="thank-msg">You are about to register with ilosool.com, please agree to ilOsool <a href="{{ URL::route('page', 'terms') }}" target="_blank">Terms of Use & Privacy Policy</a> and subscribe to our newsletter to recieve the latest news & updates.</p>
        
        <div class="form-group">
            <div class="checkbox">
                {{ Form::checkbox('subscribed', '1', true, array('id' => 'subscribed')) }}
                {{ Form::label('subscribed', 'Subscribe to ilOsool newsletter') }}
            </div>
        </div>

        <div class="form-group {{ $errors->first('agree') ? 'has-error' : '' }}">
            <div class="checkbox">
                {{ Form::checkbox('agree', '1', null, array('id' => 'agree')) }}
                <label for="agree" class="control-label">I have read and agree to ilOsool <a href="{{ URL::route('page', 'terms') }}" target="_blank">Terms of Use</a></label>
                <div class="help-block">{{ $errors->first('agree') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="3"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
        <button type="submit" class="btn btn-lg btn-primary">Register</button>
    </div>
</div>
