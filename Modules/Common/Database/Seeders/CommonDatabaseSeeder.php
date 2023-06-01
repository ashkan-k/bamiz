<?php

namespace Modules\Common\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;

class CommonDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Province::factory(15)->create();
//        City::factory(15)->create();
        // $this->call("OthersTableSeeder");
    }
}
