<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'                      => 'Admin',
            'email'                     => 'admin@gmail.com',
            'password'                  => Hash::make('admin123'),
            'email_verified_at'         => \Carbon\Carbon::now(),
            'created_at'                => \Carbon\Carbon::now()

        ]);
    }
}
