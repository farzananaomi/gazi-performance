<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        //$this->call(IngredientsSeeder::class);
       // $this->call(ProductGroupSeeder::class);
      //  $this->call(OverheadSeeder::class);
      //  $this->call(UserSeeder::class);
    }
}
