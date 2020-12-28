<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class myAppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'id' => 1,
            'name' => 'Rahul Prjapati',
            'email' => 'rahul@gmail.com',
            'email_verified_at' =>null,
            'password' => Hash::make('rahul12345'),
            'isAdmin' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],[
            'id' => 2,
            'name' => 'Umang Sharma',
            'email' => 'umang@gmail.com',
            'email_verified_at' =>null,
            'password' => Hash::make('umang12345'),
            'isAdmin' => true,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],[
            'id' => 3,
            'name' => 'Ankur',
            'email' => 'ankur@yahoo.com',
            'email_verified_at' =>null,
            'password' => Hash::make('ankur12345'),
            'isAdmin' => false,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ],[
                'id' => 4,
                'name' => 'User1',
                'email' => 'user1@gmail.com',
                'email_verified_at' =>null,
                'password' => Hash::make('123456789'),
                'isAdmin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 5,
                'name' => 'User2',
                'email' => 'user2@gmail.com',
                'email_verified_at' =>null,
                'password' => Hash::make('123456789'),
                'isAdmin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 6,
                'name' => 'User3',
                'email' => 'user3@gmail.com',
                'email_verified_at' =>null,
                'password' => Hash::make('123456789'),
                'isAdmin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 7,
                'name' => 'User4',
                'email' => 'user4@gmail.com',
                'email_verified_at' =>null,
                'password' => Hash::make('123456789'),
                'isAdmin' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
