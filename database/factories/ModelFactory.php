<?php

namespace Budgeit;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (\Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'currency_name' => 'USD',
        'currency_symbol' => '$',
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(BudgetGroup::class, function (\Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->words(2, true),
        'order' => $faker->randomDigitNotNull,
        'type' => 'expense',
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(BudgetItem::class, function (\Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->words(2, true),
        'amount' => $faker->numberBetween(1, 50000),
        'note' => $faker->paragraph(2),
        'date' => $faker->date,
        'type' => 'expense',
        'order' => $faker->randomDigitNotNull,
        'interest' => null,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});