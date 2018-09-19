<?php

use App\User;
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
        // Remove dummy user records if it exist
        User::truncate();

        $faker = \Faker\Factory::create();

        // Create some dummy users
        // Hash password for security purpose
        $password =  Hash::make('tighten');

        // User::create([
        //     'name'  => 'dummyuser',
        //     'email' => 'dummyuser@test.com',
        //     'password'  => $password
        // ]);

        for ($i = 0; $i < 1; $i++) {
            User::create([
                'name'  => $faker->name,
                'email' => $faker->email,
                'password'  => $password
            ]);
        }
    }
}
