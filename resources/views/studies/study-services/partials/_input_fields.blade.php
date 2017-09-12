	<div class="columns">
		<h3>Accomodation Services</h3>
	</div>
	<div class="columns">
		<div class="column is-5">
			<div class="bootstrap-cplex form-container">
	            {!! BootForm::checkbox('accomodation_hotel', 'Accomodation: Hotel Accomodation') !!}
	            {!! BootForm::checkbox('accomodation_relocation', 'Accomodation: Relocation') !!}
	        </div>
		</div>
	</div>

	<div class="columns">
		<h3>Air Services</h3>
	</div>
	<div class="columns">
		<div class="column is-5">
	        <div class="bootstrap-cplex form-container">
	            {!! BootForm::checkbox('air_ambulance', 'Air: Ambulance') !!}
	            {!! BootForm::checkbox('air_commercial', 'Air: Commercial') !!}
	        </div>
        </div>
	</div>

	<div class="columns">
		<h3>Ground Services</h3>
	</div>
	<div class="columns">
		<div class="column is-5">
	        <div class="bootstrap-cplex form-container" id="ground-services">
	            {!! BootForm::checkbox('ground_ambulance', 'Ground: Ambulance')->attribute('class', 'ground-ambulance') !!}
	            {!! BootForm::checkbox('ground_sedan', 'Ground: Sedan')->attribute('class', 'ground-sedan') !!}
	            {!! BootForm::checkbox('ground_shared', 'Ground: Shared')->attribute('class', 'ground-shared') !!}
	            {!! BootForm::checkbox('ground_wav', 'Ground: WAV')->attribute('class', 'ground-wav') !!}
	            {!! BootForm::select('ground_default', null, $groundServiceTypes )->attribute('class', 'ground-default') !!}
	        </div>
        </div>
	</div>

	<div class="columns">
		<h3>Payment Services</h3>
	</div>
	<div class="columns">
		<div class="column is-5">
	        <div class="bootstrap-cplex form-container">
	            {!! BootForm::checkbox('payments_reimbursement', 'Payments: Reimbursement') !!}
	            {!! BootForm::checkbox('payments_stipend', 'Payments: Stipend') !!}
	        </div>
        </div>
	</div>

	<div class="columns">
		<h3>Other Services</h3>
	</div>
	<div class="columns">
		<div class="column is-5">
	        <div class="bootstrap-cplex form-container">
	            {!! BootForm::checkbox('visa_passport', 'Visa and Passport') !!}
	            {!! BootForm::checkbox('traveling_nurse', 'Traveling Nurse') !!}
	            {!! BootForm::checkbox('travel_companion', 'Travel Companion') !!}
	            {!! BootForm::checkbox('international_health_insurance', 'International Health Insurance') !!}
	        </div>
        </div>
	</div>


	{!! Form::buSubmitButton() !!}


