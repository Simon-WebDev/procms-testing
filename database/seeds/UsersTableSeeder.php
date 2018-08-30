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
        //reset users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        //insert 3 users/authors
        DB::table('users')->insert([
        	[
        	'name' => 'John Doe',
        	'email' => 'john@fake.com',
        	'password' => bcrypt('secret')
            ],

        	[
        	'name' => 'Jane Doe',
        	'email' => 'jane@fake.com',
        	'password' => bcrypt('secret')
            ],

        	[
        	'name' => 'Edo Doe',
        	'email' => 'edo@fake.com',
        	'password' => bcrypt('secret')
            ]
    	]);
    }
}
