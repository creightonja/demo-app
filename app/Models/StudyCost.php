<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyCost extends Model
{
	protected $fillable = [
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

        'airfare_qty'                    ,
        'home_to_airport_qty'            ,
        'airport_to_site_qty'            ,
        'site_to_airport_qty'            ,
        'hotel_qty'                      ,
        'meal_per_diem_qty'              ,
        'stipend_qty'                    ,
        'expense_reimbursement_qty'      ,
        'local_home_to_site_qty'         ,
        'local_meal_per_diem_qty'        ,
        'local_stipend_qty'              ,
        'local_expense_reimbursement_qty',
	];

    public function study()
    {
    	return $this->belongsTo('App\Models\Study');
    }
}
