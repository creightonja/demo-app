    <div class="bootstrap-cplex">
        {!! BootForm::text('name') !!}
        {!! BootForm::text('protocol_number') !!}
        {!! BootForm::text('protocol_link') !!}
        {!! BootForm::text('study_size') !!}
        {!! BootForm::text('patient_visit_agenda') !!}
        {!! BootForm::textArea('study_overview') !!}
        {!! Form::buMultiSelect('country_ids', $countries, $study->countries, [], 'Countries') !!}
        {!! Form::buMultiSelect('site_ids', $sites, $study->sites, [], 'Sites', 'true', 'site_facility_string') !!}
        {!! BootForm::textarea('notes') !!}

        {!! Form::buSubmitButton() !!}
    </div>
