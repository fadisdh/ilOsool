<div class="modal-body popup-profile-body">
	<div class="row">
		<div class="col-md-3">
			<img class="popup-profile-img" src="{{ ($staff->image) ? asset($staff->getImage()) : asset('images/default-staff-img.png') }}"/>
		</div>
		<div class="col-md-9">
			<h3 class="popup-profile-name">{{$staff->name}}</h3>
			<h4 class="popup-profile-position">{{$staff->position}}</h4>
			<h4 class="popup-profile-type">{{$staff->type}}</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="popup-profile-description">
				{{$staff->description}}
			</div>
		</div>
	</div>
</div>