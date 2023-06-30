<?php

namespace Modules\WorkTime\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\WorkTime\Entities\WorkTime;

class WorkTimeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        WorkTime::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
