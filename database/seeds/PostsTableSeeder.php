<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset posts table
        DB::table('posts')->truncate();
        //insert posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::create(2018,8,21,16);
        $publishedDate = clone($date);
        $createdDate = clone($date);
        

        for ($i=1; $i <= 10; $i++) {  
        	$image= "Post_Image_" . rand(1,5) . ".jpg";
        	$date->addDays(1);
        	$posts[] = [
        		'author_id' => rand(1,3),
        		'title' => $faker->sentence(rand(8,12)),
        		'excerpt' => $faker->text(rand(250,300)),
        		'body' => $faker->paragraphs(rand(10,15), true),
        		'slug' => $faker->slug(),
        		'image' => rand(0,1) == 1 ? $image : NULL,
        		'created_at' => $createdDate,
        		'updated_at' => $createdDate,
                'published_at' => $i <= 5 ? $date : (rand(0,1) == 0 ? NULL : $publishedDate->addDays($i)),
                'category_id' => rand(1,5)

        	];


        }
        DB::table('posts')->insert($posts);
    }
}
