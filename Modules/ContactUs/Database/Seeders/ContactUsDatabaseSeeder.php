<?php

namespace Modules\ContactUs\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ContactUs\Entities\ContactUs;

class ContactUsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ContactUs::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
