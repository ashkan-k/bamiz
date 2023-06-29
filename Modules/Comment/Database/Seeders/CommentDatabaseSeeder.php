<?php

namespace Modules\Comment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Entities\Comment;

class CommentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Comment::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
