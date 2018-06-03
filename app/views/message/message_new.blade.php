<div class="comment">
	<div class="comment-img">
		<img src="{{ (Auth::user()->image) ? asset(Auth::user()->getImage()) : asset('images/default-staff-img.png') }}" class="img" />
	</div>
	<div class="comment-text">
		<h3 class="title">You</h3>
		<div class="text">
			{{ Form::textarea('content', null, array('class' => 'textarea anim', 'placeholder' => trans('profile.messages.reply'))) }}
			{{ Form::submit(trans('general.send'), array('class' => 'submit anim')) }}
		</div>
	</div>
</div>