<div id="requestfiles-res">

	{{ Form::open(array('route' => array('add.bookmark.post', $company->id),
						'class' => 'form-horizontal ajax',
						'data-res' => '#requestfiles-res')) }}
	@if(isset($folder_id))
		{{ Form::hidden('folder_id', $folder_id) }}
	@endif

	<div class="modal-body popup-bookmarks-body">
		<div class="form-group {{ isset($selected) ? 'has-error' : '' }}">
			{{ Form::label('folder', trans('profile.my_bookmarks.folder'), array('class' => 'control-label col-md-3')) }}
			<div class="col-md-9">
				<select id="folder-select" class="form-control" name="folder">
		        	<option value="0">{{trans('general.select')}}</option>
		           	<?php
		           	foreach($folders as $folder){
		            	echo '<option "' . (isset($folder_id) && $folder_id == $folder->id ? '" selected=selected "'  :  '" "') . '" value="' . $folder->id . '">' . $folder->name . '</option>';
		            }
		           	?>
	           		@if(isset($error))
	           			<option value="new" selected="selected">{{trans('general.new')}}</option>
	           		@else
	           			<option value="new">{{trans('general.new')}}</option>
	           		@endif
		        </select>
		        @if( isset($selected) && $selected == false )
					<div class="help-block">{{trans('general.messages.select_folder')}}</div>
				@endif
		    </div>
		</div>
		<div id="folder-new" class="form-group folder-new {{ isset($error) ? 'has-error' : '' }}">
		 	{{ Form::label('folder_name', trans('profile.my_bookmarks.folder_name'), array('class' => 'control-label col-md-3')) }}
		 	<div class="col-md-9">
				{{ Form::text('folder_name', isset($error) ? $folder_name : '', array('class' => 'form-control')) }}
				@if( isset($error) && $error == true )
					<div class="help-block">{{trans('validation.custom.correct_value')}}</div>
				@endif
			</div>
			
		</div>
	</div>
	
	<div class="modal-footer popup-bookmarks-footer">
		{{ Form::submit(trans('general.confirm'), array('class' => 'btn btn-primary ajax')) }}
		<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
	</div>
	{{ Form::token() }}
    {{ Form::close() }}
</div>