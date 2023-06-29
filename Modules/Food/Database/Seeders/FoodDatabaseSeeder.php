<?php

namespace Modules\Food\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Food\Entities\Food;

class FoodDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Food::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
