<?php

namespace Modules\Reserve\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Reserve\Entities\Reserve;

class ReserveDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Reserve::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
