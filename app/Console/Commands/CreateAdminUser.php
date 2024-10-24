<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

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
    protected $description = 'Create an admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('aemtechnology');
        $email = $this->ask('moiseayola4@gmail.com');
        $password = $this->secret('atalasse9421016385');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'admin'
        ]);

        $this->info('Admin user created successfully.');
    }
}