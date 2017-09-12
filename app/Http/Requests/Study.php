<?php

namespace App\Http\Requests;

class Study extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                          => 'required|min:3',
            'protocol_number'               => 'required',
            'study_size'                    => 'required|integer',
            'patient_visit_agenda'          => 'required',
            'study_overview'                => 'required',
            'country_ids'                   => 'required',
            'notes'                         => 'nullable',
        ];
    }
}
