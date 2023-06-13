<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name' => 'Country 1'],
            ['name' => 'Country 2'],
            ['name' => 'Country 3'],
            ['name' => 'Country 4'],
            ['name' => 'Country 5'],
            ['name' => 'Country 6'],
            ['name' => 'Country 7'],
            ['name' => 'Country 8'],
            ['name' => 'Country 9'],
            ['name' => 'Country 10'],
        ];

        Country::insert($countries);
    }
}
