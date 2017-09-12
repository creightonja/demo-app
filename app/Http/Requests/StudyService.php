<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyService extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accomodation_hotel'                => 'nullable|boolean',
            'accomodation_relocation'           => 'nullable|boolean',
            'air_ambulance'                     => 'nullable|boolean',
            'air_commercial'                    => 'nullable|boolean',
            'ground_ambulance'                  => 'nullable|boolean',
            'ground_sedan'                      => 'nullable|boolean',
            'ground_shared'                     => 'nullable|boolean',
            'ground_wav'                        => 'nullable|boolean',
            'international_health_insurance'    => 'nullable|boolean',
            'payments_reimbursement'            => 'nullable|boolean',
            'payments_stipend'                  => 'nullable|boolean',
            'visa_passport'                     => 'nullable|boolean',
            'traveling_nurse'                   => 'nullable|boolean',
            'travel_companion'                  => 'nullable|boolean',
            'ground_default'                    => 'nullable|integer',
        ];
    }
}
