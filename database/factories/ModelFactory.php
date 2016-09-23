<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Cliente::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->safeEmail,
    ];
});

$factory->define(App\Pedido::class, function () {
    return [
        'cliente_id' => function() {
        return factory(App\Cliente::class)->create()->id;
        }
    ];
});