<?php

namespace Modules\WishList\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\WishList\Entities\WishList;

class WishListDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        WishList::factory(15)->create();

        // $this->call("OthersTableSeeder");
    }
}
