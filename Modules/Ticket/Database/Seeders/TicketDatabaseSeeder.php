<?php

namespace Modules\Ticket\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Entities\TicketAnswer;
use Modules\Ticket\Entities\TicketCategory;

class TicketDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        TicketCategory::factory(5)->create();
        Ticket::factory(5)->create();
        TicketAnswer::factory(5)->create();

        // $this->call("OthersTableSeeder");
    }
}
