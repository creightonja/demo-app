<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\Sponsor;
use App\Models\Patient;
use App\Models\StudyService;
use App\Models\PatientService;
use Illuminate\Http\Request;
use App\Http\Requests\StudyService as StudyServiceRequest;

class StudyServiceController extends Controller
{

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Study $study)
    {
    	$studyService = new StudyService;
        $groundServiceTypes = config('study_services.ground_service_types');
    	return view('studies.study-services.create', compact('study', 'studyService', 'groundServiceTypes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudyServiceRequest $request, Study $study)
    {
    	$sponsor = Sponsor::find($study->sponsor_id);

    	$this->processCheckBoxParameters($request);
        $studyService = new StudyService($request->all());
        $studyService->study_id = $study->id;

        // Update set up on study object
        $study->load('studyCost');
        $study->set_up_complete = isset($study->studyCost);

        $this->flash(($studyService->save() && $study->save()), 'create', 'Study Travel Parameters');

        return redirect()->route('sponsors.studies.show', [$sponsor, $study]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Study $study, StudyService $studyService)
    {
        $groundServiceTypes = config('study_services.ground_service_types');
        return view('studies.study-services.edit', compact('study', 'studyService', 'groundServiceTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(StudyServiceRequest $request, Study $study, StudyService $studyService)
    {
        // Check for new values in request
        $this->processCheckBoxParameters($request);
        $this->processTrueFalseValues($studyService);
        $serviceChanges = $studyService->compareServices($request->all());

        // Update each of the associated patients travel services
        $study->load('patients.patientService');
        forEach($study->patients as $patient) {
            if ($patient->patientService) {
                $patientService = PatientService::find($patient->patientService->id);
                $patientService->fill($serviceChanges);
                $patientService->save();
            }
        }

        $this->flash($studyService->update($request->all()), 'update', 'Study Travel Parameters');
        $sponsor = Sponsor::find($study->sponsor_id);

        return redirect()->route('sponsors.studies.show', compact('sponsor', 'study'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $study
     * @param  object  $studyService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study $study, StudyService $studyService)
    {
    	// Update set up on study object
        $study->set_up_complete = false;
    	$sponsor = Sponsor::find($study->sponsor_id);

        $this->flash(($studyService->delete() && $study->save()), 'delete', 'Study Travel Parameters');

        return redirect()->route('sponsors.studies.show', [$sponsor, $study]);
    }

    public function processCheckBoxParameters($request)
    {
        collect([
	        'accomodation_hotel',
	        'accomodation_relocation',
	        'air_ambulance',
	        'air_commercial',
	        'ground_ambulance',
	        'ground_sedan',
	        'ground_shared',
	        'ground_wav',
	        'international_health_insurance',
	        'payments_reimbursement',
	        'payments_stipend',
	        'visa_passport',
	        'traveling_nurse',
	        'travel_companion'
        ])->each(function($parameter) use ($request) {
                $request->merge([$parameter => $request->has($parameter)]);
            });
    }

    public function processTrueFalseValues($studyService)
    {
        collect([
            'accomodation_hotel',
            'accomodation_relocation',
            'air_ambulance',
            'air_commercial',
            'ground_ambulance',
            'ground_sedan',
            'ground_shared',
            'ground_wav',
            'international_health_insurance',
            'payments_reimbursement',
            'payments_stipend',
            'visa_passport',
            'traveling_nurse',
            'travel_companion'
        ])->each(function($parameter) use ($studyService) {
                $studyService[$parameter] = (bool) $studyService[$parameter];
            });
    }
}
