<?php

use Illuminate\Database\Seeder;

class ChaptersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chapters')->truncate();

        DB::table('chapters')->insert([
        	[
        		'title' => 'chapter1',
        		'slug' => 'chapter-1'
        	],
        	[
        		'title' => 'chapter2',
        		'slug' => 'chapter-2'
        	],
        	[
        		'title' => 'chapter3',
        		'slug' => 'chapter-3'
        	],
        	[
        		'title' => 'chapter4',
        		'slug' => 'chapter-4'
        	]
        	
        ]);
    }
}
