<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;
use App\Group;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//reset boards table
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
    	DB::table('boards')->truncate();

    	//insert 36 posts data
    	$boards = [];
    	$faker = Factory::create();
    	$date = Carbon::now()->modify('-1 year');
    	$groups = Group::pluck('id');

    	for ($i=1; $i < 3000; $i++) { 
			$image1= "Post_Image_" . rand(1,5) . ".jpg";
			$image2= "Post_Image_" . rand(1,5) . ".jpg";
			$date->addDay();
		    $publishedDate = clone($date);
		    $createdDate = clone($date);

    		$boards[] = [
    			'user_id' => rand(1,3),
    			'title' => $faker->sentence,
    			'slug'  => $faker->slug(),
    			'body'  => $faker->paragraphs(rand(1,5), true),
    			'image1' => rand(0,1) == 1 ? $image1 : NULL,
    			'image2' => rand(0,1) == 1 ? $image2 : NULL,
    			'created_at' => $createdDate,
    			'updated_at' => $createdDate,
    			'group_id' => rand(1,$groups->count()),
                'is_active' =>rand(0,1),
    			'view_count' => rand(1,10)*10
    		];
    	}
    	DB::table('boards')->insert($boards);
        
    }
}
