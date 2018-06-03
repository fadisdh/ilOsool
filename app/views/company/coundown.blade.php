<li class="clearfix">
	@if($company->isEnded())
		<h2 class="time-left-end">The Deal is Finished</h2>
	@else
		<h2 class="time-left-end" style="display:none;">The Deal is Finished</h2>
		<div id="timer" class="time-left">
			<div class="number days">
				<h4>Days</h4>
				<h2 id="timer-days">{{ $company->daysLeft() }}</h2>
			</div>
			<div class="separator">
				<h4>&nbsp;</h4>
			</div>
			<div class="number">
				<h4>Hours</h4>
				<h2 id="timer-hours">{{ $company->hoursLeft() }}</h2>
			</div>
			<div class="separator">
				<h4>&nbsp;</h4>
				<h2>:</h2>
			</div>
			<div class="number">
				<h4>Min</h4>
				<h2 id="timer-mins">{{ $company->minutesLeft() }}</h2>
			</div>
			<div class="separator">
				<h4>&nbsp;</h4>
				<h2>:</h2>
			</div>
			<div class="number">
				<h4>Sec</h4>
				<h2 id="timer-secs">{{ $company->secondsLeft() }}</h2>
			</div>
		</div>
	@endif
</li>