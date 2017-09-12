<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Study extends Model
{
    use \App\Models\Presenters\StudyPresenter;

    protected $fillable = [ 'name', 'protocol_number', 'protocol_link', 'study_size', 'patient_visit_agenda',
        'study_overview', 'notes' 
    ];

    public function countries()
    {
        return $this->belongsToMany('App\Models\Country');
    }

    public function patients()
    {
    	return $this->hasMany('App\Models\Patient');
    }

    public function sponsor()
    {
    	return $this->belongsTo('App\Models\Sponsor');
    }

    public function cro()
    {
    	return $this->belongsTo('App\Models\Cro');
    }

    public function sites()
    {
        return $this->belongsToMany('App\Models\Site');
    }

    public function studyService()
    {
        return $this->hasOne('App\Models\StudyService');
    }

    public function studyCost()
    {
        return $this->hasOne('App\Models\StudyCost');
    }

    public function updateCountries($countryIds)
    {

        // $existingCountries  = explode(',', DB::table('country_study')->where('study_id', $this->id)->pluck('country_id')->implode(','));
        // TODO: verify if this works the same as above
        $existingCountries  = $this->countries->pluck('id')->toArray();
        $countryIds ? $selectedCountries  = explode(',', $countryIds) : $selectedCountries = [];
        
        $removeCountries    = array_diff($existingCountries, $selectedCountries);
        $addCountries       = array_diff($selectedCountries, $existingCountries);

        if (!empty($removeCountries)) {
            $this->countries()->detach($removeCountries);
        }

        if (!empty($addCountries)) {
            $this->countries()->attach($addCountries);
        }

    }

    public function updateSites($siteIds)
    {
        $existingSites  = $this->sites->pluck('id')->toArray();
        $siteIds ? $selectedSites  = explode(',', $siteIds) : $selectedSites = [];
        

        $removeSites    = array_diff($existingSites, $selectedSites);
        $addSites       = array_diff($selectedSites, $existingSites);

        if (!empty($removeSites)) {
            $this->sites()->detach($removeSites);
        }

        if (!empty($addSites)) {
            $this->sites()->attach($addSites);
        }
    }
    
}
