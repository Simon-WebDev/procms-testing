<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
        	[
        		'title' => 'Uncategoriezed',
        		'slug' => 'uncategorized'
        	],
        	[
        		'title' => 'Tips and Tricks',
        		'slug' => 'tips-and-tricks'
        	],
        	[
        		'title' => 'Build Apps',
        		'slug' => 'build-apps'
        	],
        	[
        		'title' => 'News',
        		'slug' => 'news'
        	],
        	[
        		'title' => 'Freebies',
        		'slug' => 'freebies'
        	]
        ]);

        
        

       
    }
}
