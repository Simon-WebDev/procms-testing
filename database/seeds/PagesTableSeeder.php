<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory;
use App\User;
use App\Chapter;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//reset table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('pages')->truncate();

        $pages = [];
        $faker = Factory::create();
        $date = Carbon::now()->modify('-1 year');
        $users = User::pluck('id');
        $chapters = Chapter::pluck('id');
        

        for ($i=1; $i <= 3000; $i++) {  
        	$image= "Post_Image_" . rand(1,5) . ".jpg";
        	//$date->addDay();
            // $publishedDate = clone($date);
            $createdDate = clone($date);

        	$pages[] = [
        		'user_id' => rand(1,3),
        		'title' => $faker->sentence(rand(8,12)),
        		'excerpt' => $faker->text(rand(250,300)),
        		'body' => $faker->paragraphs(rand(10,15), true),
        		'image' => rand(0,1) == 1 ? $image : NULL,
        		'created_at' => $createdDate,
        		'updated_at' => $createdDate,
                'is_active' => rand(0,1),
                'user_id' => rand(1,$users->count()),
                'chapter_id' => rand(1,$chapters->count()),
                'view_count' => rand(1,10)*10

        	];


        }
        DB::table('pages')->insert($pages);
    }
}
