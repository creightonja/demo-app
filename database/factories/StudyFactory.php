<?php

$factory->define(App\Models\Study::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->catchPhrase,
        'protocol_number' => $faker->unique()->ean8,
        'protocol_link' => $faker->url,
        'sponsor_id' => function() {
        	return factory('App\Models\Sponsor')->create();
        },
        'cro_id' => function() {
        	return factory('App\Models\Cro')->create();
        },
        'study_size' => rand(0, 500),
        'patient_visit_agenda' => $faker->sentence . PHP_EOL . $faker->sentence,
        'study_overview' => $faker->sentence(),
        'notes' => $faker->paragraph
    ];
});
