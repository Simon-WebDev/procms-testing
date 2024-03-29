<?php

use App\Category;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('posts')->truncate();
        //insert 36 posts data
        $posts = [];
        $faker = Factory::create();
        $date = Carbon::now()->modify('-1 year');
        $categories = Category::pluck('id');
        

        for ($i=1; $i <= 3000; $i++) {  
        	$image= "Post_Image_" . rand(1,5) . ".jpg";
        	//$date->addDay();
            $publishedDate = clone($date);
            $createdDate = clone($date);

        	$posts[] = [
        		'author_id' => rand(1,3),
        		'title' => $faker->sentence(rand(8,12)),
        		'excerpt' => $faker->text(rand(250,300)),
        		'body' => $faker->paragraphs(rand(10,15), true),
        		'slug' => $faker->slug(),
        		'image' => rand(0,1) == 1 ? $image : NULL,
        		'created_at' => $createdDate,
        		'updated_at' => $createdDate,
                'published_at' => $i < 3000 ? $publishedDate : ( rand(0, 1) == 0 ? NULL : $publishedDate->addDay() ),
                'category_id' => rand(1,5),
                'view_count' => rand(1,10)*10

        	];


        }
        DB::table('posts')->insert($posts);
    }
}
