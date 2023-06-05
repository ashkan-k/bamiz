<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Article\Entities\Article;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Article::factory(15)->create();
        // $this->call("OthersTableSeeder");
    }
}
