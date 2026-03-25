<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'filament:make-user';
    protected $description = 'Create a new user';

    public function handle()
    {
        $name = $this->ask('Name?');
        $email = $this->ask('Email?');
        $password = $this->secret('Password?');

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->info('User created!');
    }
}