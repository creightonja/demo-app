<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\StudyCost;
use App\Models\Sponsor;
use App\Http\Requests\StudyCost as StudyCostRequest;
use Illuminate\Http\Request;

class StudyCostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param object $study
     * @return \Illuminate\Http\Response
     */
    public function create(Study $study)
    {
        $studyCost = new StudyCost;
        return view('studies.study-costs.create', compact('study', 'studyCost'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\StudyCost  $request
     * @param  \Illuminate\Models\Study             $study
     * @return \Illuminate\Http\Response
     */
    public function store(StudyCostRequest $request, Study $study)
    {
        $sponsor = Sponsor::find($study->sponsor_id);

        $values = array_merge($request->all(), $this->processMoney($request->all()));
        $studyCost = new StudyCost($values);
        $studyCost->study_id = $study->id;

        // Update set up on study object
        $study->load('studyService');
        $study->set_up_complete = isset($study->studyService);

        $this->flash(($studyCost->save() && $study->save()), 'create', 'Study Costs');

        return redirect()->route('sponsors.studies.show', [$sponsor, $study]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object $study
     * @param  object $studyCost
     * @return \Illuminate\Http\Response
     */
    public function edit(Study $study, StudyCost $studyCost)
    {
        return view('studies.study-costs.edit', compact('study', 'studyCost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Requests\StudyCost  $request
     * @param  object  $study
     * @param  object  $studyCost
     * @return \Illuminate\Http\Response
     */
    public function update(StudyCostRequest $request, Study $study, StudyCost $studyCost)
    {
        $values = array_merge($request->all(), $this->processMoney($request->all()));
        $this->flash($studyCost->update($values), 'update', 'Study Costs');
        $sponsor = Sponsor::find($study->sponsor_id);

        return redirect()->route('sponsors.studies.show', compact('sponsor', 'study'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $study
     * @param  object  $studyCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Study $study, StudyCost $studyCost)
    {
        // Update set up on study object
        $study->set_up_complete = false;
        $sponsor = Sponsor::find($study->sponsor_id);

        $this->flash(($studyCost->delete() && $study->save()), 'delete', 'Study Costs');

        return redirect()->route('sponsors.studies.show', [$sponsor, $study]);
    }

    private function processMoney($values)
    {
        $fields = [
            'airfare'                        ,
            'home_to_airport'                ,
            'airport_to_site'                ,
            'site_to_airport'                ,
            'hotel'                          ,
            'meal_per_diem'                  ,
            'stipend'                        ,
            'expense_reimbursement'          ,
            'local_home_to_site'             ,
            'local_meal_per_diem'            ,
            'local_stipend'                  ,
            'local_expense_reimbursement'    ,
        ];

        $returnValues = [];

        forEach($fields as $field) {
            if (strpos($values[$field], '.') !== false) {
                $returnValues[$field] = str_replace('.', '', $values[$field]);
            } else {
                $returnValues[$field] = $values[$field] . '00';
            }
        }
        return $returnValues;
    }
}
