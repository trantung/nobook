<?php

namespace App\Console\Commands\System;

use App\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = 'Admin';
        $email = 'admin@nobook.asia';
        $password = 'admin@123';
        User::query()
            ->updateOrCreate(
                [
                    'email' => 'admin@nobook.asia',
                ],
                [
                    'name' => $name,
                    'password' => bcrypt('admin@123'),
                ]
            );

        $this->info('Admin created!');
        $this->info("Email: {$email}");
        $this->info("Password: {$password}");
    }
}
