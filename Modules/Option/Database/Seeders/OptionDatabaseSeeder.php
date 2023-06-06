<?php

namespace Modules\Option\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Option\Entities\Option;
use Modules\Option\Entities\OptionPlace;

class OptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Option::factory(15)->create();
        OptionPlace::factory(15)->create();

        // $this->call("OthersTableSeeder");
    }
}
