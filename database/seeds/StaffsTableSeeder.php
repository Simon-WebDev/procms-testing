<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('staffs')->truncate();

            $faker = Factory::create();
            //insert 3 users/authors
            DB::table('staffs')->insert([
            	[
            	'name' => '박박사',
            	'major' => '내과',
            	'color' => $faker->hexcolor
                ],
        		[
        		'name' => '최박사',
        		'major' => '외과',
        		'color' => $faker->hexcolor
        	    ],
    	    	[
    	    	'name' => '김박사',
    	    	'major' => '정신과',
    	    	'color' => $faker->hexcolor
    	        ],
	            [
		          	'name' => '이박사',
		          	'major' => '산부인과',
		          	'color' => $faker->hexcolor
	            ],
        	]);
    }
}
