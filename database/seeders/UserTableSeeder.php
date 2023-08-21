<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // for admin
            [
                'full_name' => 'Abir Admin',
                'user_name' => 'Admin',
                'email' => 'emartadmin@gmail.com',
                'password' => Hash::make('emartadmin'),
                'role' => 'admin',
                'status' => 'Active',
            ],
            //for vendor
            [
                'full_name' => 'Nur Vendor',
                'user_name' => 'Nur Vendor',
                'email' => 'nurvendor@gmail.com',
                'password' => Hash::make('vendor'),
                'role' => 'vendor',
                'status' => 'Active',
            ],
            //for customer
            [
                'full_name' => 'Rocky Customer',
                'user_name' => 'Customer',
                'email' => 'rockycustomer@gmail.com',
                'password' => Hash::make('customer'),
                'role' => 'customer',
                'status' => 'Active',
            ],
        ]);
    }
}
