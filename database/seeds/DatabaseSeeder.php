<?php

use Illuminate\Database\Seeder;
use App\House;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        House::truncate();

        factory(App\House::class,50)->create();
    }
}
