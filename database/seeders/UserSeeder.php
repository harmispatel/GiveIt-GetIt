<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'mobile' => '9685324565',
            'user_type' => '1',
            'password' =>  bcrypt('admin@123'),
            'status' => '1',
        ]);
        
    }
}
