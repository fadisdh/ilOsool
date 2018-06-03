<div class="form-group {{ $errors->first('owner') ? 'has-error' : '' }}">
    {{ Form::label('Owner', 'Owner Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        @if(isset($company))
            {{ Form::text('owner', null, array('class' => 'form-control', 'id' => 'autocomplete', 'data-id' => $company->user_id, 'data-name' => $company->user->firstname . ' ' . $company->user->lastname . " '" . $company->user->email . "'" )) }}
        @else
            {{ Form::text('owner', null, array('class' => 'form-control', 'id' => 'autocomplete')) }}
        @endif
        <div class="help-block">{{ $errors->first('owner') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('slug') ? 'has-error' : '' }}">
    {{ Form::label('slug', 'Slug', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('slug', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('slug') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('deal_name') ? 'has-error' : '' }}">
    {{ Form::label('deal_name', 'Deal Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('deal_name', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('deal_name') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Listing Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('name', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#name_hidden" data-value="{{ Input::old('name') ? Input::old('name_hidden') : ($company->id ? $companyHidden->name : 1) }}"></div>
        {{ Form::checkbox('name_hidden', 1, Input::old('name') ? Input::old('name_hidden') : ($companyHidden->name ? $companyHidden->name : null), array('id' => 'name_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('name_arabic') ? 'has-error' : '' }}">
    {{ Form::label('name_arabic', 'Arabic Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('name_arabic', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('name_arabic') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#name_arabic_hidden" data-value="{{ Input::old('name_arabic') ? Input::old('name_arabic_hidden') : ($company->id ? $companyHidden->name_arabic : 1) }}"></div>
        {{ Form::checkbox('name_arabic_hidden', 1, Input::old('name_arabic') ? Input::old('name_arabic_hidden') : ($companyHidden->name_arabic ? $companyHidden->name_arabic : null), array('id' => 'name_arabic_hidden','class' => 'hide')) }}
    </div>
 </div>

<div class="form-group {{ $errors->first('started') ? 'has-error' : '' }}">
    {{ Form::label('started', 'Founded Year', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('started', isset($company->started) ? $company->started : Input::old('started'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('started',  'The founding year must be a valid year.') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#started_hidden" data-value="{{ Input::old('started') ? Input::old('started_hidden') : ($company->id ? $companyHidden->started : 1) }}"></div>
        {{Form::checkbox('started_hidden', 1, Input::old('started') ? Input::old('started_hidden') : ($companyHidden->started ? $companyHidden->started : null), array('id' => 'started_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::textarea('description', null, array('class' => 'form-control editor')) }}
        <div class="help-block">{{ $errors->first('description') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#description_hidden" data-value="{{ Input::old('description') ? Input::old('description_hidden') : ($company->id ?$companyHidden->description : 1) }}"></div>
        {{ Form::checkbox('description_hidden', 1, Input::old('description') ? Input::old('description_hidden') : ($companyHidden->description ? $companyHidden->description : null), array('id' => 'description_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
    {{ Form::label('brief', 'Brief', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::textarea('brief', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('brief') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('image', 'Image', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-9">
            @if(isset($company))
                @if($company->image)
                    <img class="adminview-image" src="{{ asset($company->getImage()) }}" />
                @else
                    <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_company_image')) }}" />
                @endif
            @endif
            {{ Form::file( 'image', '',null, array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group">
    {{ Form::label('image', 'Logo', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-9">
            @if(isset($company))
                @if($company->logo)
                    <img class="adminview-image" src="{{ asset($company->getLogo()) }}" />
                @else
                    <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_company_image')) }}" />
                @endif
            @endif
            {{ Form::file( 'logo', '',null, array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group {{ $errors->first('video') ? 'has-error' : '' }}">
    {{ Form::label('video', 'Video', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('video', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('video') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#video_hidden" data-value="{{ Input::old('video') ? Input::old('video_hidden') : ($company->id ? $companyHidden->video : 1) }}"></div>
        {{ Form::checkbox('video_hidden', 1, Input::old('video') ? Input::old('video_hidden') : ($companyHidden->video ? $companyHidden->video : null), array('id' => 'video_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('tags') ? 'has-error' : '' }}">
    {{ Form::label('tags', 'Tags', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::textarea('tags', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
    {{ Form::label('address', 'Address', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::textarea('address', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('address') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#address_hidden" data-value="{{ Input::old('address') ? Input::old('address_hidden') : ($company->id ? $companyHidden->address : 1) }}"></div>
        {{Form::checkbox('address_hidden', 1, Input::old('address') ? Input::old('address_hidden') : ($companyHidden->address ? $companyHidden->address : null), array('id' => 'address_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
    {{ Form::label('city', 'City', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('city', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('city') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
    {{ Form::label('country', 'Country', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('country') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
    {{ Form::label('phone', 'Phone Number', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('phone', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('phone') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#phone_hidden" data-value="{{ Input::old('phone') ? Input::old('phone_hidden') : ($company->id ? $companyHidden->phone : 1) }}"></div>
        {{ Form::checkbox('phone_hidden', 1, Input::old('phone') ? Input::old('phone_hidden') : ($companyHidden->phone ? $companyHidden->phone : null), array('id' => 'phone_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'E-Mail Address', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::email('email',null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('email') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#email_hidden" data-value="{{ Input::old('email') ? Input::old('email_hidden') : ($company->id ? $companyHidden->email : 1) }}"></div>
        {{Form::checkbox('email_hidden', 1, Input::old('email') ? Input::old('email_hidden') : ($companyHidden->email ? $companyHidden->email : null), array('id' => 'email_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('website', 'Website', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('website', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#website_hidden" data-value="{{ Input::old('website') ? Input::old('website_hidden') : ($company->id ? $companyHidden->website : 1) }}"></div>
        {{Form::checkbox('website_hidden', 1, Input::old('website') ? Input::old('website_hidden') : ($companyHidden->website ? $companyHidden->website : null), array('id' => 'website_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('map') ? 'has-error' : '' }}">
    {{ Form::label('map', 'Map', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
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
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('map') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('social') ? 'has-error' : '' }}">
    {{ Form::label('social', 'Social Links', array('class' => 'control-label col-md-2')) }}
    <?php 
        $socialName = Input::get('socialname', array());
        $socialValue = Input::get('sociallink', array());
        $social = array();
        if($socialName){
            foreach($socialName as $key => $value){
                $social[$value] = $socialValue[$key];
            }
        }elseif(isset($company)){
            $social = $company->social;
        }
    ?>
    @if(isset($company))
        @if(isset($social))
        <?php $count = 0; ?>
            @foreach ($social as $key => $value)
                <?php $count++; ?>
                @if($count == 1)
                    <div class="col-md-9">
                @else
                    <div class="col-md-9 col-md-offset-2">
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
                            <input type="text" name="sociallink[]" value="{{ $value }}" class="form-control col-lg-8" />
                            @if($count > 1)
                                <span class="input-group-btn">
                                    <a href="#" class="social-delete btn btn-danger">&times;</a>
                                </span>
                            @endif
                        </div>
                    </div>
            @endforeach
        @endif
    @else
        <div class="col-md-10">
            <div class="input-group">
                <span class="input-group-btn">
                    <select name="socialname[]" class="form-control" style="width: 150px; border-right: 0;">
                        <option>SELECT</option>
                       <?php
                        foreach(Config::get('ilosool.social') as $skey => $sval){
                            echo '<option value="' . $skey . '">' . $sval . '</option>';
                        }
                       ?> 
                    </select>
                </span>
                <input type="text" name="sociallink[]" class="form-control col-lg-8" />
            </div>
        </div>
    @endif
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#social_hidden" data-value="{{ Input::old('social') ? Input::old('social_hidden') : ($company->id ? $companyHidden->social : 1) }}"></div>
    {{ Form::checkbox('social_hidden', 1, Input::old('social') ? Input::old('social_hidden') : ($companyHidden->social ? $companyHidden->social : null), array('id' => 'social_hidden','class' => 'hide')) }}
    </div>
    <div id="social-holder"></div>
    <div class="col-md-9 col-md-offset-2">
        <button id="social-add" type="button" class="btn btn-default btn-sm btn-block">Add new social link</button>
    </div>
    <script id="social-tmpl" type="text/x-jquery-tmpl">
      <div class="col-md-9 col-md-offset-2">
        <div class="input-group">
            <span class="input-group-btn">
            <select name="socialname[]" class="form-control" style="width: 150px; border-right: 0;">
                <option>SELECT</option>
               <?php
                foreach(Config::get('ilosool.social') as $skey => $sval){
                    echo '<option value="' . $skey . '">' . $sval . '</option>';
                }
               ?> 
            </select>
            </span>
            <input type="text" name="sociallink[]" class="form-control col-lg-8" />
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

<div class="form-group {{ $errors->first('geo_interests') ? 'has-error' : '' }}">
    {{ Form::label('geo_interests[]', 'Operation Locations', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getCheckboxes('geo_interests', 'geo_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('sector') ? 'has-error' : '' }}">
    {{ Form::label('sector', 'Investment Sector', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getSelect('vc_sector_interests', 'sector') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('sector') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
    {{ Form::label('investment_stage', 'Investment Stage', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getSelect('vc_investment_stage', 'investment_stage') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
    {{ Form::label('investment_type', 'Investment Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getSelect('investment_type', 'investment_type') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_style') ? 'has-error' : '' }}">
    {{ Form::label('investment_style', 'Investment Style', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getSelect('investment_style', 'investment_style') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('investment_style') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
    {{ Form::label('deal_size', 'Deal Size', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ getSelect('vc_deal_size', 'deal_size') }}
    </div>
    <div class="col-md-9 col-md-offset-2">
        <div class="help-block">{{ $errors->first('deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('cfb') ? 'has-error' : '' }}">
    {{ Form::label('cfb', 'Commission from Buyer', array('class' => 'control-label col-md-2')) }}
    <div class="input-group col-md-9">
        {{ Form::text('cfb', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">%</span>
        <div class="help-block">{{ $errors->first('cfb') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('startdate') ? 'has-error' : '' }}">
    {{ Form::label('startdate', 'Investment Start date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        <?php $date = date('Y-m-d'); ?>
        {{ Form::date('startdate', isset($company->startdate) ? $company->startdate : ( Input::old('startdate') ? Input::old('startdate') : $date ), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('startdate') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#startdate_hidden" data-value="{{ Input::old('startdate') ? Input::old('startdate_hidden') : ($company->id ? $companyHidden->startdate : 1) }}"></div>
        {{ Form::checkbox('startdate_hidden', 1, Input::old('startdate') ? Input::old('startdate_hidden') : ($companyHidden->startdate ? $companyHidden->startdate : null), array('id' => 'startdate_hidden','class' => 'hide')) }}
    </div>
</div>

<!-- <div class="form-group {{ $errors->first('enddate') ? 'has-error' : '' }}">
    {{ Form::label('enddate', 'Investment End Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::date('enddate', isset($company->enddate) ? $company->enddate : Input::old('started'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('enddate') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#enddate_hidden" data-value="{{ Input::old('enddate') ? Input::old('enddate_hidden') : ($company->id ? $companyHidden->enddate : 1) }}"></div>
        {{ Form::checkbox('enddate_hidden', 1, Input::old('enddate') ? Input::old('enddate_hidden') : ($companyHidden->enddate ? $companyHidden->enddate : null), array('id' => 'enddate_hidden','class' => 'hide')) }}
    </div>
</div> -->

<div class="form-group {{ $errors->first('price_shares') ? 'has-error' : '' }}">
    {{ Form::label('price_shares', 'Price per Share', array('class' => 'control-label col-md-2')) }}
    <div class="input-group input-group-select col-md-9">
        {{ Form::text('price_shares', null, array('class' => 'form-control')) }}
        {{ Form::currency('price_shares_suffix', $company->price_shares_suffix ? $company->price_shares_suffix : null) }}
        <div class="help-block">{{ $errors->first('price_shares') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#price_shares_hidden" data-value="{{ Input::old('price_shares') ? Input::old('price_shares_hidden') : ($company->id ? $companyHidden->price_shares : 1) }}"></div>
        {{ Form::checkbox('price_shares_hidden', 1, Input::old('price_shares') ? Input::old('price_shares_hidden') : ($companyHidden->price_shares ? $companyHidden->price_shares : null), array('id' => 'price_shares_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('number_shares') ? 'has-error' : '' }}">
    {{ Form::label('number_shares', 'Number of Shares', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('number_shares', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('number_shares') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#number_shares_hidden" data-value="{{ Input::old('number_shares') ? Input::old('number_shares_hidden') : ($company->id ? $companyHidden->number_shares : 1) }}"></div>
        {{ Form::checkbox('number_shares_hidden', 1, Input::old('number_shares') ? Input::old('number_shares_hidden') : ($companyHidden->number_shares ? $companyHidden->number_shares : null), array('id' => 'number_shares_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('price_earning') ? 'has-error' : '' }}">
    {{ Form::label('price_earning', 'Revenue', array('class' => 'control-label col-md-2')) }}
    <div class="input-group col-md-9">
        {{ Form::text('price_earning', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">x</span>
        <div class="help-block">{{ $errors->first('price_earning') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#price_earning_hidden" data-value="{{ Input::old('price_earning') ? Input::old('price_earning_hidden') : ($company->id ? $companyHidden->price_earning : 1) }}"></div>
        {{ Form::checkbox('price_earning_hidden', 1, Input::old('price_earning') ? Input::old('price_earning_hidden') : ($companyHidden->price_earning ? $companyHidden->price_earning : null), array('id' => 'price_earning_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('growth_rate') ? 'has-error' : '' }}">
    {{ Form::label('growth_rate', 'Growth Rate', array('class' => 'control-label col-md-2')) }}
    <div class="input-group col-md-9">
        {{ Form::text('growth_rate', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">%</span>
        <div class="help-block">{{ $errors->first('growth_rate') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#growth_rate_hidden" data-value="{{ Input::old('growth_rate') ? Input::old('growth_rate_hidden') : ($company->id ? $companyHidden->growth_rate : 1) }}"></div>
        {{ Form::checkbox('growth_rate_hidden', 1, Input::old('growth_rate') ? Input::old('growth_rate_hidden') : ($companyHidden->growth_rate ? $companyHidden->growth_rate : null), array('id' => 'growth_rate_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('percentage') ? 'has-error' : '' }}">
    {{ Form::label('percentage', 'Percentage from Company', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::text('percentage', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('percentage') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#percentage_hidden" data-value="{{ Input::old('percentage') ? Input::old('percentage_hidden') : ($company->id ?  $companyHidden->percentage : 1) }}"></div>
        {{ Form::checkbox('percentage_hidden', 1, Input::old('percentage') ? Input::old('percentage_hidden') : ($companyHidden->percentage ? $companyHidden->percentage : null), array('id' => 'percentage_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('leverage_ratio') ? 'has-error' : '' }}">
    {{ Form::label('leverage_ratio', 'Leverage Ratio', array('class' => 'control-label col-md-2')) }}
    <div class="input-group col-md-9">
        {{ Form::text('leverage_ratio', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">%</span>
        <div class="help-block">{{ $errors->first('leverage_ratio') }}</div>
    </div>
     <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#leverage_ratio_hidden" data-value="{{ Input::old('leverage_ratio') ? Input::old('leverage_ratio_hidden') : ($company->id ? $companyHidden->leverage_ratio : 1) }}"></div>
        {{ Form::checkbox('leverage_ratio_hidden', 1, Input::old('leverage_ratio') ? Input::old('leverage_ratio_hidden') : ($companyHidden->leverage_ratio ? $companyHidden->leverage_ratio : null), array('id' => 'leverage_ratio_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('target') ? 'has-error' : '' }}">
    {{ Form::label('target', 'Investment Target', array('class' => 'control-label col-md-2')) }}
    <div class="input-group input-group-select col-md-9">
        {{ Form::text('target', null, array('class' => 'form-control')) }}
        {{ Form::currency('target_suffix', $company->target_suffix ? $company->target_suffix : null) }}
        <div class="help-block">{{ $errors->first('target') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#target_hidden" data-value="{{ Input::old('target') ? Input::old('target_hidden') : ($company->id ? $companyHidden->target : 1) }}"></div>
        {{ Form::checkbox('target_hidden', 1, Input::old('target') ? Input::old('target_hidden') : ($companyHidden->target ? $companyHidden->target : null), array('id' => 'target_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('min_investment') ? 'has-error' : '' }}">
    {{ Form::label('min_investment', 'Minimum Investment', array('class' => 'control-label col-md-2')) }}
    <div class="input-group input-group-select col-md-9">
        {{ Form::text('min_investment', null, array('class' => 'form-control')) }}
        {{ Form::currency('min_investment_suffix', $company->min_investment_suffix ? $company->min_investment_suffix : null) }}
        <div class="help-block">{{ $errors->first('min_investment') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#min_investment_hidden" data-value="{{ Input::old('min_investment') ? Input::old('min_investment_hidden') : ($company->id ?  $companyHidden->min_investment : 1) }}"></div>
        {{ Form::checkbox('min_investment_hidden', 1, Input::old('min_investment') ? Input::old('min_investment_hidden') : ($companyHidden->min_investment ? $companyHidden->min_investment : null), array('id' => 'min_investment_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('current') ? 'has-error' : '' }}">
    {{ Form::label('current', 'Current Investment Amount', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
       {{ Form::text('current', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('current') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('featured', 'Featured', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::select('featured', Config::get('ilosool.company_featured'), null, array('class' => 'form-control')) }}
    </div>
</div>

@if(can('company.show_contact'))
    <div class="form-group">
        {{ Form::label('show_contact', 'Show Contact Info', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-9">
            {{ Form::select('show_contact', Config::get('ilosool.show_contact'), null, array('class' => 'form-control')) }}
        </div>
    </div>
@endif

<div class="form-group {{ $errors->first('status') ? 'has-error' : '' }}">
    {{ Form::label('status', 'Status', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::select('status', Config::get('ilosool.deal_status'), isset($company) ? null : 'published', array('class' => 'form-control', 'autocomplete' => 'off')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('listing_status') ? 'has-error' : '' }}">
    {{ Form::label('listing_status', 'Listing Status', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::select('listing_status', Config::get('ilosool.listing_status'), isset($company) ? null : 'open', array('class' => 'form-control', 'autocomplete' => 'off')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('approved', 'Approved', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-9">
        {{ Form::select('approved', Config::get('ilosool.company_approved'), null, array('class' => 'form-control')) }}
    </div>
</div>

{{ Form::token(); }}

<div class="form-group">
    <div class="col-md-9 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.companies') }}" class="btn btn-default">Cancel</a>
    </div>
</div>