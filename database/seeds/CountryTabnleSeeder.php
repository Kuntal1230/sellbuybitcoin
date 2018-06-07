<?php

use Illuminate\Database\Seeder;

class CountryTabnleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Country::class, 196)->create();
    }
}
