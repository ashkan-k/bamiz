<?php

namespace Modules\Cooperation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cooperation\Entities\Cooperation;

class CooperationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Cooperation::factory(15)->create();

        // $this->call("OthersTableSeeder");
    }
}
