<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    $str = Str::random(6);
    $array = array('MacMillian','Marvel','Bantam Books');
    $time = strtotime(now());
    $tmz = date('Y-m-d',$time);
    return [
        'name' => $faker->word,
        'isbn' => "ISBN-".$str,
        'authors' => $faker->name,
        'country' => $faker->country,
        'number_of_pages' => $faker->randomDigit,
        'publisher' => $faker->randomElement($array),
        'release_date' => $tmz,
    ];
});
