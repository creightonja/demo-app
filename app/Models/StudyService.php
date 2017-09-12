<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyService extends Model
{
	protected $fillable = [        
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
        'travel_companion',
        'ground_default',
    ];

    public function study()
    {
    	return $this->belongsTo('App\Models\Study');
    }


    public function compareServices($newServices)
    {
        $existingServices   = $this->toArray();
        $addServices = array_diff_assoc($newServices, $existingServices);
        unset($addServices['_token'], $addServices['_method']);

        return $addServices;
    }
}
