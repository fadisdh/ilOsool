<div class="form-group {{ $errors->first('owner') ? 'has-error' : '' }}">
    {{ Form::label('Owner', 'Company Owner', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
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
    <div class="col-md-10">
       {{ Form::text('slug', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('slug') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Company Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('name', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('fancyname') ? 'has-error' : '' }}">
	{{ Form::label('fancyname', 'Fancy Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::text('fancyname', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('fancyname') }}</div>
    </div>
 </div>

<div class="form-group {{ $errors->first('started') ? 'has-error' : '' }}">
	{{ Form::label('started', 'Company Starting Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::date('started', isset($company->started) ? $company->started : Input::old('started'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('started') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
	{{ Form::label('email', 'E-Mail Address', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::email('email',null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('email') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('website', 'Website', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('website', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
	{{ Form::label('city', 'City', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::text('city', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('city') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
	{{ Form::label('country', 'Country', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('country') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
	{{ Form::label('address', 'Address', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::textarea('address', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('address') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('cfb') ? 'has-error' : '' }}">
    {{ Form::label('cfb', 'Commission from Buyer', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('cfb', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('cfb') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
	{{ Form::label('phone', 'Phone Number', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
    	{{ Form::text('phone', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('phone') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('description', null, array('class' => 'form-control editor')) }}
        <div class="help-block">{{ $errors->first('description') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
    {{ Form::label('brief', 'Brief', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('brief', null, array('class' => 'form-control editor')) }}
        <div class="help-block">{{ $errors->first('brief') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('image', 'Image', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
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
        <div class="col-md-10">
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
    <div class="col-md-10">
        {{ Form::text('video', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('video') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('map') ? 'has-error' : '' }}">
    {{ Form::label('map', 'Map', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
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
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
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
                    <div class="col-md-10">
                @else
                    <div class="col-md-10 col-md-offset-2">
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
    <div id="social-holder"></div>
    <div class="col-md-10 col-md-offset-2">
        <button id="social-add" type="button" class="btn btn-default btn-sm btn-block">Add new social link</button>
    </div>
    <script id="social-tmpl" type="text/x-jquery-tmpl">
      <div class="col-md-10 col-md-offset-2">
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

<div class="form-group {{ $errors->first('tags') ? 'has-error' : '' }}">
    {{ Form::label('tags', 'Tags', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('tags', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
    {{ Form::label('type', 'Company Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('type[]', 'pe', null, array('id' => 'pe')) }}
             {{ Form::label('pe', 'Private Equity') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('type[]', 'vc', null, array('id' => 'vc')) }}
            {{ Form::label('vc', 'Venture Capital') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('type[]', 're', null, array('id' => 're')) }}
            {{ Form::label('re', 'Real Estate') }}
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('sector') ? 'has-error' : '' }}">
   {{ Form::label('sector', 'Company Sector', array('class' => 'control-label col-md-2')) }}
   <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','ict','',array('id' => 'ict')) }}
            {{ Form::label('ict', 'Information & Comm. Tecnology') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','health','',array('id' => 'health')) }}
            {{ Form::label('health', 'Health Sector') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','finance','',array('id' => 'finance')) }}
            {{ Form::label('finance', 'Finance Sector') }}
        </div>
    </div>

    <div class="col-md-3 col-md-offset-2">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','hotels','',array('id' => 'hotels')) }}
            {{ Form::label('hotels', 'Hotels') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','housing','',array('id' => 'housing')) }}
            {{ Form::label('housing', 'Housing') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector[]','construction','',array('id' => 'construction')) }}
            {{ Form::label('construction', 'Constructions') }}
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('sector') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('yield') ? 'has-error' : '' }}">
    {{ Form::label('yield', 'Yield', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('yield', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('yield') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('shares') ? 'has-error' : '' }}">
    {{ Form::label('shares', 'Shares', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('shares', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('shares') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('private_equity') ? 'has-error' : '' }}">
    {{ Form::label('private_equity', 'Private Equity', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('private_equity', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('private_equity') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('price_sqf') ? 'has-error' : '' }}">
    {{ Form::label('price_sqf', 'Price per sqf', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('price_sqf', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('price_sqf') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('growth_rate') ? 'has-error' : '' }}">
    {{ Form::label('growth_rate', 'Growth Rate', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('growth_rate', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('growth_rate') }}</div>
    </div>
</div>

<!-- Investment -->
<div class="form-group {{ $errors->first('investment_title') ? 'has-error' : '' }}">
    {{ Form::label('investment_title', 'Investment Title', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('investment_title', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('investment_title') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
    {{ Form::label('investment_stage', 'Investment Stage', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','management','',array('id' => 'management')) }}
            {{ Form::label('management', 'Management') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','buyout','',array('id' => 'buyout')) }}
            {{ Form::label('buyout', 'Buyout') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','distressed','',array('id' => 'distressed')) }}
            {{ Form::label('distressed', 'Distressed') }}
        </div>
    </div>

    <div class="col-md-3 col-md-offset-2">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','preipo','',array('id' => 'preipo')) }}
            {{ Form::label('preipo', 'Pre IPO') }}
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('startdate') ? 'has-error' : '' }}">
    {{ Form::label('startdate', 'Investment Start date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::datetime('startdate', isset($company->startdate) ? $company->startdate : Input::old('startdate'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('startdate') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('enddate') ? 'has-error' : '' }}">
    {{ Form::label('enddate', 'Investment End Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::datetime('enddate', isset($company->enddate) ? $company->enddate : Input::old('started'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('enddate') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('target') ? 'has-error' : '' }}">
    {{ Form::label('target', 'Investment Target', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('target', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('target') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('min_investment') ? 'has-error' : '' }}">
    {{ Form::label('min_investment', 'Minimum Investment', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('min_investment', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('min_investment') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('geo_interest') ? 'has-error' : '' }}">
    {{ Form::label('geo_interest[]', 'Geo interests:', array('class' => 'control-label col-md-2')) }}
    @foreach(Config::get('ilosool.geo_interest') as $key => $region )            
        <div class="col-md-2">
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('geo_interest[]', $key, null, array('id' => $key)) }}
                    {{ Form::label($key, $region) }}
                </label>
            </div>
        </div>
    @endforeach
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('geo_interest') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
    {{ Form::label('investment_type[]', 'Investment Type:', array('class' => 'control-label control-label col-md-2')) }}
        <div class="col-md-2">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','minority', null, array('id' => 'minority')) }}
                {{ Form::label('minority', 'Minority') }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','majority', null, array('id' => 'majority')) }}
                {{ Form::label('majority', 'Majority') }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','passive', null, array('id' => 'passive')) }}
                {{ Form::label('passive', 'Passive') }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','active', null, array('id' => 'active')) }}
                {{ Form::label('active', 'Active') }}
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-10 col-md-offset-2">
            <div class="help-block">{{ $errors->first('investment_type') }}</div>
        </div>
</div>

<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
    {{ Form::label('deal_size', 'Deal Size', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('deal_size', null, array('class' => 'form-control')) }}       
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('deal_size') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('featured', 'Featured', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('featured', Config::get('ilosool.company_featured'), null, array('class' => 'form-control')) }}
    </div>
</div>

@if(can('company.show_contact'))
    <div class="form-group">
        {{ Form::label('show_contact', 'Show Contact Info', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
            {{ Form::select('show_contact', Config::get('ilosool.show_contact'), null, array('class' => 'form-control')) }}
        </div>
    </div>
@endif

<div class="form-group {{ $errors->first('status') ? 'has-error' : '' }}">
    {{ Form::label('status', 'Status', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('status', Config::get('ilosool.deal_status'), isset($company) ? null : 'published', array('class' => 'form-control', 'autocomplete' => 'off')) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('approved', 'Approved', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('approved', Config::get('ilosool.company_approved'), null, array('class' => 'form-control')) }}
    </div>
</div>

{{ Form::token(); }}

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.companies') }}" class="btn btn-default">Cancel</a>
    </div>
</div>