<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudyCost extends FormRequest
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
            'airfare'                           => 'nullable|numeric',
            'home_to_airport'                   => 'nullable|numeric',
            'airport_to_site'                   => 'nullable|numeric',
            'site_to_airport'                   => 'nullable|numeric',
            'hotel'                             => 'nullable|numeric',
            'meal_per_diem'                     => 'nullable|numeric',
            'stipend'                           => 'nullable|numeric',
            'expense_reimbursement'             => 'nullable|numeric',
            'local_home_to_site'                => 'nullable|numeric',
            'local_meal_per_diem'               => 'nullable|numeric',
            'local_stipend'                     => 'nullable|numeric',
            'local_expense_reimbursement'       => 'nullable|numeric',

            'airfare_qty'                       => 'nullable|integer',
            'home_to_airport_qty'               => 'nullable|integer',
            'airport_to_site_qty'               => 'nullable|integer',
            'site_to_airport_qty'               => 'nullable|integer',
            'hotel_qty'                         => 'nullable|integer',
            'meal_per_diem_qty'                 => 'nullable|integer',
            'stipend_qty'                       => 'nullable|integer',
            'expense_reimbursement_qty'         => 'nullable|integer',
            'local_home_to_site_qty'            => 'nullable|integer',
            'local_meal_per_diem_qty'           => 'nullable|integer',
            'local_stipend_qty'                 => 'nullable|integer',
            'local_expense_reimbursement_qty'   => 'nullable|integer',
        ];
    }
}
