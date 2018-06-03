@extends('layouts.site')

@section('title')
  
  	@if(getLocale() == 'en')
		{{Config::get('ilosool.type.'.$type)}} Request
	@else
		{{trans('request.request')}} {{trans('general.' . Config::get('ilosool.type.'.$type))}}
	@endif
@stop

@section('content')
	@parent

    <div class="page-img image-no-border"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    @include('profile.topmenu')
	   <div class="container">
        <div class="page-container page-top">
            <!-- <div class="hline"></div> -->
            <div class="page-content">
            	@if(getLocale() == 'en')
                	<h2 class="page-title">{{trans('request.request')}} {{Config::get('ilosool.type.'.$type)}} {{trans('request.deal')}}</h2>
                @else
                	<h2 class="page-title">{{trans('request.request')}} {{trans('request.deal')}} {{trans('general.' . Config::get('ilosool.type.'.$type))}}</h2>
                @endif

                <?php if($request->id) $id = $request->id;	else $id = 0; ?>
                
                {{ Form::model($request, array('route' => array('request.deal.post', $id, $type), 'class' => 'form-horizontal')) }}
                    <div class="form-group {{ $errors->first('geo_interests') ? 'has-error' : '' }}">
					    <label for="geo_interests[]" class="control-label col-md-12">{{trans('request.label.geo_interests')}}</label>
					    <div class="row">
						    <div class="col-md-12">
						        {{ getCheckboxes('geo_interests', 'geo_interests[]', 'col-md-3') }}
						    </div>
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('geo_interests') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
					    <label for="investment_stage" class="control-label col-md-12">{{trans('request.label.investment_stage')}}</label> 
					    <div class="col-md-12">
					        {{ getCheckboxes($type.'_investment_stage', 'investment_stage[]', 'col-md-3') }}
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('investment_sector') ? 'has-error' : '' }}">
					    <label for="investment_sector" class="control-label col-md-12">{{trans('request.label.investment_sector')}}</label> 
					    <div class="col-md-12">
					        {{ getCheckboxes($type.'_sector_interests', 'investment_sector[]', 'col-md-3') }}
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('investment_sector') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
					    <label for="investment_type" class="control-label col-md-12">{{trans('request.label.investment_type')}}</label> 
					    <div class="col-md-12">
					        {{ getCheckboxes('investment_type', 'investment_type[]', 'col-md-3') }}
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('investment_type') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('investment_style') ? 'has-error' : '' }}">
					    <label for="investment_style" class="control-label col-md-12">{{trans('request.label.investment_style')}}</label> 
					    <div class="col-md-12">
					        {{ getCheckboxes('investment_style', 'investment_style[]', 'col-md-3') }}
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('investment_style') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
					    <label for="deal_size" class="control-label col-md-12">{{trans('request.label.deal_size')}}</label> 
					    <div class="row">
						    <div class="col-md-12">
						        {{ getCheckboxes($type.'_deal_size', 'deal_size[]', 'col-md-3') }}
						    </div>
						</div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('deal_size') }}</div>
					    </div>
					</div>

					@if($type == "vc")
						<div class="form-group {{ $errors->first('growth_rate') ? 'has-error' : '' }}">
						    <label for="growth_rate" class="control-label col-md-12">{{trans('request.label.growth_rate')}}</label> 
						    <div class="input-group col-md-12">
						        {{ Form::text('growth_rate', null, array('class' => 'form-control')) }}
						        <span class="input-group-addon">%</span>
						    </div>
						    <div class="col-md-7">
						        <div class="help-block">{{ $errors->first('growth_rate') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('revenue') ? 'has-error' : '' }}">
						    <label for="revenue" class="control-label col-md-12">{{trans('request.label.revenue')}}</label> 
						    <div class="input-group  input-group-select col-md-12">
						        {{ Form::text('revenue', null, array('class' => 'form-control')) }}
						        {{ Form::currency('revenue_suffix', null) }}
						    </div>
						    <div class="col-md-7">
						        <div class="help-block">{{ $errors->first('revenue') }}</div>
						    </div>
						</div>
					@endif

					@if($type == 'pe')
						<div class="form-group {{ $errors->first('price_earning') ? 'has-error' : '' }}">
						    <label for="price_earning" class="control-label col-md-12">{{trans('request.label.maximum_price_earning')}}</label> 
						    <div class="input-group col-md-12">
						        {{ Form::text('price_earning', null, array('class' => 'form-control')) }}
						        <span class="input-group-addon">x</span>
						    </div>
						    <div class="col-md-7 col-md-offset-3">
						        <div class="help-block">{{ $errors->first('price_earning') }}</div>
						    </div>
						</div>
					@endif

					@if($type == 're')
						<div class="form-group {{ $errors->first('yield') ? 'has-error' : '' }}">
						    <label for="yield" class="control-label col-md-12">{{trans('request.label.minimum_yield')}}</label>
						    <div class="input-group col-md-12">
						        {{ Form::text('yield', null, array('class' => 'form-control')) }}
						        <span class="input-group-addon">%</span>
						    </div>
						    <div class="col-md-7">
						        <div class="help-block">{{ $errors->first('yield') }}</div>
						    </div>
						</div>
					@endif

					<div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
						    <label for="brief" class="control-label col-md-12">{{trans('request.label.one_liner')}}</label> 
						    <div class="col-md-12">
						        {{ Form::text('brief', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-7">
						        <div class="help-block">{{ $errors->first('brief') }}</div>
						    </div>
						</div>

					<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
					    <label for="description" class="control-label col-md-12">{{trans('request.description')}}</label> 
					    <div class="input-group col-md-12">
					        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-7">
					        <div class="help-block">{{ $errors->first('description') }}</div>
					    </div>
					</div>
					
					<div class="form-group">
					    <div class="col-md-12">
					        <button type="submit" class="btn btn-lg btn-primary">{{trans('request.request')}}</button>
					    </div>
					</div>

                {{ Form::token(); }}
            	{{ Form::close() }}
            </div>
        </div>
    </div>
@stop