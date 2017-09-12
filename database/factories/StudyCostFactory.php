<?php

$factory->define(App\Models\StudyCost::class, function (Faker\Generator $faker) {
    return [
        'study_id'                      => 1,
        'airfare'                       => $faker->numberBetween(1000, 50000),
        'home_to_airport'               => $faker->numberBetween(1000, 50000),
        'airport_to_site'               => $faker->numberBetween(1000, 50000),
        'site_to_airport'               => $faker->numberBetween(1000, 50000),
        'hotel'                         => $faker->numberBetween(1000, 50000),
        'meal_per_diem'                 => $faker->numberBetween(1000, 50000),
        'stipend'                       => $faker->numberBetween(1000, 50000),
        'expense_reimbursement'         => $faker->numberBetween(1000, 50000),
        'local_home_to_site'            => $faker->numberBetween(1000, 50000),
        'local_meal_per_diem'           => $faker->numberBetween(1000, 50000),
        'local_stipend'                 => $faker->numberBetween(1000, 50000),
        'local_expense_reimbursement'   => $faker->numberBetween(1000, 50000),

        'airfare_qty'                   => $faker->numberBetween(100, 500),
        'home_to_airport_qty'           => $faker->numberBetween(100, 500),
        'airport_to_site_qty'           => $faker->numberBetween(100, 500),
        'site_to_airport_qty'           => $faker->numberBetween(100, 500),
        'hotel_qty'                     => $faker->numberBetween(100, 500),
        'meal_per_diem_qty'             => $faker->numberBetween(100, 500),
        'stipend_qty'                   => $faker->numberBetween(100, 500),
        'expense_reimbursement_qty'     => $faker->numberBetween(100, 500),
        'local_home_to_site_qty'        => $faker->numberBetween(100, 500),
        'local_meal_per_diem_qty'       => $faker->numberBetween(100, 500),
        'local_stipend_qty'             => $faker->numberBetween(100, 500),
        'local_expense_reimbursement_qty' => $faker->numberBetween(100, 500),
    ];
});