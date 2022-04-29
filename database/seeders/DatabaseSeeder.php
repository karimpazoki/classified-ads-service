<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::factory()
            ->count(2)
            ->has(Province::factory()
                ->count(3)
                ->has(
                    City::factory()
                    ->count(3)
                    ->hasUsers(5)
                )
            )
            ->create();

        Brand::factory()
            ->count(10)
            ->create();
    }
}
