<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Password!1'),
            'admin' => true,
        ]);
        $admin->save();
    }
}
