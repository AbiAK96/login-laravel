<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'address'=>'AK',
            'email' => 'abishek@gmail.com',
            'mobile' => '083873987',
            'password' => Hash::make('12345678'),
            'email_verified_at'=> '2022-01-02 17:04:58',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
