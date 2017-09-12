<?php

$factory->define(App\Models\StudyService::class, function (Faker\Generator $faker) {

    return [	
        'accomodation_hotel'                => $faker->boolean,
        'accomodation_relocation'           => $faker->boolean,
        'air_ambulance'                     => $faker->boolean,
        'air_commercial'                    => $faker->boolean,
        'ground_ambulance'                  => $faker->boolean,
        'ground_sedan'                      => $faker->boolean,
        'ground_shared'                     => $faker->boolean,
        'ground_wav'                        => $faker->boolean,
        'international_health_insurance'    => $faker->boolean,
        'payments_reimbursement'            => $faker->boolean,
        'payments_stipend'                  => $faker->boolean,
        'visa_passport'                     => $faker->boolean,
        'traveling_nurse'                   => $faker->boolean,
        'travel_companion'                  => $faker->boolean,
        'ground_default'                    => $faker->numberBetween(0, 3),
        'study_id'                          => 1, // Setting study id to one for tests, will be overriden in dummy data command
    ];
});
