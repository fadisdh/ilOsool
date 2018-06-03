<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
    <label for="description" class="control-label col-md-2 col-md-offset-1">{{trans('deal.description')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.description')}}">[?]</a></label>
    <div class="col-md-7">
        {{ Form::textarea('description', null, array('class' => 'form-control editor')) }}
        <div class="help-block">{{ $errors->first('description') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#description_hidden" data-value="{{ Input::old('description') ? Input::old('description_hidden') : ($company->id ?$companyHidden->description : 1) }}"></div>
        {{ Form::checkbox('description_hidden', 1, Input::old('description') ? Input::old('description_hidden') : ($companyHidden->description ? $companyHidden->description : null), array('id' => 'description_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
    <label for="brief" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.brief')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.brief')}}">[?]</a></label>    
    <div class="col-md-7">
        {{ Form::textarea('brief', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('brief') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('image') ? 'has-error' : '' }}">
    <label for="image" class="control-label col-md-2 col-md-offset-1">{{trans('deal.image')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.image')}}">[?]</a></label>
        <div class="col-md-7">
            @if($company->image)
                <img src="{{ asset($company->getImage()) }}" class="company-img"/>
            @else
                <img src="{{ asset(Config::get('ilosool.default_company_image')) }}" class="company-img"/>
            @endif
            {{ Form::file( 'image', '',null, array('class' => 'form-control')) }}
            <div class="help-block">{{ $errors->first('image') }}</div>
        </div>
</div>

<div class="form-group {{ $errors->first('logo') ? 'has-error' : '' }}">
    <label for="logo" class="control-label col-md-2 col-md-offset-1">{{trans('deal.logo')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.logo')}}">[?]</a></label>
        <div class="col-md-7">
            @if($company->logo)
                <img src="{{ asset($company->getLogo()) }}" class="company-logo" />
            @else
                <img src="{{ asset(Config::get('ilosool.default_company_image')) }}" class="company-logo" />
            @endif
            {{ Form::file( 'logo', '',null, array('class' => 'form-control')) }}
            <div class="help-block">{{ $errors->first('logo') }}</div>
        </div>
</div>

<div class="form-group {{ $errors->first('video') ? 'has-error' : '' }}">
    <label for="video" class="control-label col-md-2 col-md-offset-1">{{trans('deal.video')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.video')}}">[?]</a></label>
    <div class="col-md-7">
        {{ Form::text('video', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('video') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#video_hidden" data-value="{{ Input::old('video') ? Input::old('video_hidden') : ($company->id ? $companyHidden->video : 1) }}"></div>
        {{ Form::checkbox('video_hidden', 1, Input::old('video') ? Input::old('video_hidden') : ($companyHidden->video ? $companyHidden->video : null), array('id' => 'video_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('map') ? 'has-error' : '' }}">
    <label for="map" class="control-label col-md-2 col-md-offset-1">{{trans('deal.map')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.map')}}">[?]</a></label>
    <div class="col-md-7">
        {{ Form::text('map', null, array('id' => 'map-input', 'class' => 'form-control')) }}
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script>
            function initialize() {
              var marker = null;
              var pos = document.getElementById('map-input').value;
              var setMarker = false;
              if(pos){
                setMarker = true;
              }else{
                pos = '26.194877,23.598633';
              }
              pos = pos.split(',');

              var map = new google.maps.Map(document.getElementById('map-canvas'), {
                zoom: 4,
                center: new google.maps.LatLng(pos[0], pos[1])  
              });

              if(setMarker){
                var latlng = new google.maps.LatLng(pos[0], pos[1]);
                 marker = new google.maps.Marker({
                  position: latlng,
                  map: map
                });

                map.panTo(latlng);
              }

              google.maps.event.addListener(map, 'click', function(e) {
                if(marker){
                    marker.setMap(null);
                }

                marker = new google.maps.Marker({
                  position: e.latLng,
                  map: map
                });

                map.panTo(e.latLng);
                document.getElementById('map-input').value = e.latLng.toUrlValue();
              });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <div id="map-canvas" style="height:330px;"></div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#map_hidden" data-value="{{ Input::old('map') ? Input::old('map_hidden') : ($company->id ? $companyHidden->map : 1) }}"></div>
        {{ Form::checkbox('map_hidden', 1, Input::old('map') ? Input::old('map_hidden') : ($companyHidden->map ? $companyHidden->map : null), array('id' => 'map_hidden','class' => 'hide')) }}
    </div>
    <div class="col-md-7 col-md-offset-2">
        <div class="help-block">{{ $errors->first('map') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('social') ? 'has-error' : '' }}">
    <label for="social" class="control-label col-md-2 col-md-offset-1">{{trans('deal.social_links')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.social')}}">[?]</a></label>
    <?php 
        $socialName = Input::get('socialname', array());
        $socialValue = Input::get('sociallink', array());
        $social = array();
        if($socialName){
            foreach($socialName as $key => $value){
                $social[$value] = $socialValue[$key];
            }
        }else{
            $social = $company->social;
        }
    ?>
    @if(isset($social))
        <?php $count = 0; ?>
        @foreach ($social as $key => $value)
            <?php $count++; ?>
            @if($count == 1)
                <div class="col-md-7">
            @else
                <div class="col-md-7 col-md-offset-3">
            @endif
                    <div class="input-group">
                        <span class="input-group-btn">
                            <select name="socialname[]" class="form-control" style="width: 150px; border-right: 0;">
                                <option>SELECT</option>
                               <?php
                                foreach(Config::get('ilosool.social') as $skey => $sval){
                                    echo '<option value="' . $skey . '" ' . ($skey == $key ? 'selected="selected"' : '') . '>' . $sval . '</option>';
                                }
                               ?> 
                            </select>
                        </span>
                        <input type="text" name="sociallink[]" value="{{ $value }}" class="form-control col-lg-6" />
                        
                        @if($count > 1)
                            <span class="input-group-btn">
                                <a href="#" class="social-delete btn btn-danger">&times;</a>
                            </span>
                        @endif
                    </div>
                </div>
        @endforeach
    @else
        <div class="col-md-7">
            <div class="input-group">
                <span class="input-group-btn">
                    <select name="socialname[]" class="form-control rtl-class" style="width: 150px; border-right: 0;">
                        <option>SELECT</option>
                       <?php
                        foreach(Config::get('ilosool.social') as $skey => $sval){
                            echo '<option value="' . $skey . '">' . $sval . '</option>';
                        }
                       ?> 
                    </select>
                </span>
                <input type="text" name="sociallink[]" class="form-control col-lg-6" />
            </div>
        </div>
    @endif
        <div class="col-md-1">
            <div class="toggle toggle-modern" data-target="#social_hidden" data-value="{{ Input::old('social') ? Input::old('social_hidden') : ($company->id ? $companyHidden->social : 1) }}"></div>
        {{ Form::checkbox('social_hidden', 1, Input::old('social') ? Input::old('social_hidden') : ($companyHidden->social ? $companyHidden->social : null), array('id' => 'social_hidden','class' => 'hide')) }}
        </div>

    <div id="social-holder"></div>
    <div class="col-md-7 col-md-offset-3">
        <button id="social-add" type="button" class="btn btn-default btn-sm btn-block">{{trans('deal.add_social_link')}}</button>
    </div>
    <script id="social-tmpl" type="text/x-jquery-tmpl">
      <div class="col-md-7 col-md-offset-3">
        <div class="input-group">
            <span class="input-group-btn">
                <select name="socialname[]" class="form-control rtl-class" style="width: 150px; border-right: 0;">
                    <option>SELECT</option>
                   <?php
                    foreach(Config::get('ilosool.social') as $skey => $sval){
                        echo '<option value="' . $skey . '">' . $sval . '</option>';
                    }
                   ?> 
                </select>
            </span>
            <input type="text" name="sociallink[]" class="form-control col-lg-6" />
            <span class="input-group-btn">
                <a href="#" class="social-delete btn btn-danger">&times;</a>
            </span>
        </div>
      </div>
    </script>
    <script type="text/javascript">
      var $socialHolder = $('#social-holder');
      var $socialBtn = $('#social-add');
      var $socialTmpl = $('#social-tmpl');

      $socialBtn.click(function(event){
        event.preventDefault();
        $socialTmpl.tmpl(null).appendTo($socialHolder);
        return false;
      });

      $('body').on('click', '.social-delete', function(event){
        event.preventDefault();
        $(this).parent().parent().parent().remove();
        return false;
      });
    </script>

</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="1"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}}</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="3">{{trans('general.next')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>