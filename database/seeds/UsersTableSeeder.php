<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'farzana',
                'password' => bcrypt('1234'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
