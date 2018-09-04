<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();

        $faker = Factory::create();
        //insert 3 users/authors
        DB::table('users')->insert([
        	[
        	'name' => 'John Doe',
        	'email' => 'john@fake.com',
        	'password' => bcrypt('secret'),
            'slug' => $faker->slug,
            'bio' => $faker->text(rand(250,300))
            ],

        	[
        	'name' => 'Jane Doe',
        	'email' => 'jane@fake.com',
        	'password' => bcrypt('secret'),
            'slug' => $faker->slug, 
            'bio' => $faker->text(rand(250,300))
            ],

        	[
        	'name' => 'Edo Doe',
        	'email' => 'edo@fake.com',
        	'password' => bcrypt('secret'),
            'slug' => $faker->slug,
            'bio' => $faker->text(rand(250,300))
            ]
    	]);
    }
}
