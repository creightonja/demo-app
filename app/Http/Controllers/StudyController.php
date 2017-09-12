<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Study;
use App\Models\Patient;
use App\Models\Sponsor;
use App\Models\Cro;
use App\Models\Country;
use App\Models\Site;
use App\Http\Requests\Study as StudyRequest;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sponsor $sponsor)
    {
        $studies = $sponsor->studies()->with('sponsor', 'cro')->get();


        return view('sponsors.studies.index', compact('studies', 'sponsor')); 
   }

    public function indexAll()
    {
        $studies = Study::with('sponsor', 'cro')->get();

        return view('studies.index', compact('studies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Sponsor $sponsor)
    {
        $countries = Country::all();
        $sites = Site::all();
        $study = new Study;
        $cro = Cro::find($request->cro_id);

        return view('studies.create', compact('study', 'sponsor', 'cro', 'countries', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudyRequest $request, Sponsor $sponsor)
    {
        $cro = Cro::find($request->cro_id);

        $study = (new Study($request->all()))->sponsor()->associate($sponsor);
        $study->cro()->associate($cro);

        $this->flash($study->save(), 'create', 'Study');

        $study->countries()->attach(explode(',', $request->country_ids));
        $study->sites()->attach(explode(',', $request->site_ids));

        return redirect()->route('sponsors.studies.show', compact('sponsor', 'study'));
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor, Study $study)
    {
        $countries = Country::all();
        $study->load('patients', 'cro', 'sponsor', 'countries', 'patients.address', 'cro.address', 'sponsor.address', 'studyService', 'studyCost');
        $groundServiceTypes = config('study_services.ground_service_types');

        return view('studies.show', compact('sponsor', 'study', 'countries', 'groundServiceTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor, Study $study)
    {
        $study->load('countries', 'sites');
        $countries = Country::all();
        $sites = Site::all();

        return view('studies.edit', compact('sponsor', 'study', 'countries', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(StudyRequest $request, Sponsor $sponsor, Study $study)
    {
        $this->flash($study->update($request->all()), 'update', 'Study');
        $study->updateCountries($request->country_ids);
        $study->updateSites($request->site_ids);

        return redirect()->route('sponsors.studies.show', [$sponsor, $study]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $study
     * @param  object $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor, Study $study)
    {
        $this->flash($study->delete(), 'delete', 'Study');

        return redirect()->route('sponsors.studies.index', $sponsor);
    }

    public function selectCro(Sponsor $sponsor)
    {
        $cros = Cro::all();
        $cros->load('address');

        foreach ($cros as $cro) {
            $cro->addUri = route('sponsors.studies.create', $sponsor) . "?cro_id=$cro->id";
            $cro->showUri = route('cros.show', ['cro_id' => $cro->id]);
            $cro->addressString = $cro->address->address1 . ' ' . $cro->address->address2 . ' ' . $cro->address->city . ', ' . $cro->address->state . '  ' . $cro->address->zip;
        }
        return view('studies.selectCro', ['sponsor' => $sponsor, 'cros' => $cros]);
    }
}
