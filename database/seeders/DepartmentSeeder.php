<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countryIds = Country::pluck('id');

        $departments = [];

        for ($i = 0; $i < 10000; $i++) {
            $departments[] = [
                'name' => 'Department ' . ($i + 1),
                'country_id' => $countryIds->random(),
            ];
        }

        Department::insert($departments);
    }
}
