<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class CreateAdminUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Admin User';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::create(
            [
                'first_name' => 'اشکان',
                'last_name' => 'کریمی',
                'username' => 'ashkan',
                'email' => 'as@gmail.com',
                'phone' => '09396988720',
                'password' => Hash::make('123'),
                'email_verified_at' => Carbon::now(),
            ]
        );
        $user->level = 'admin';
        $user->save();

        $this->info("{$user->phone} admin user created...");
        return 0;
    }
}
