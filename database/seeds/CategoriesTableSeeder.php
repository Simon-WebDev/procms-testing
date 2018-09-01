<?php

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
        		'title' => 'Web Development',
        		'slug' => 'web-development'
        	],
        	[
        		'title' => 'Social Marketing',
        		'slug' => 'social-marketing'
        	],
        	[
        		'title' => 'General',
        		'slug' => 'general'
        	],
        	[
        		'title' => 'DIY',
        		'slug' => 'diy'
        	],
        	[
        		'title' => 'Facebook Development',
        		'slug' => 'facebook-development'
        	]
        ]);

       
    }
}
