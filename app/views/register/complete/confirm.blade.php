<div class="row">
    <div class="complete-reg-container col-md-8 col-md-offset-2">
        <p class="thank-msg">{{trans('register.agree_terms')}}</p>
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="3"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}} </a>
        <button type="submit" class="btn btn-lg btn-primary">{{trans('register.register')}} </button>
        <input type="hidden" name="type" value="{{ $type }}">
    </div>
</div>
