<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        DB::table('groups')->insert([
        	[
        		'title' => 'Group1',
        		'slug' => 'group1-and-slug',
                'is_open' => rand(0,1),
                'created_at' => Carbon::now()
        	],
        	[
        		'title' => 'Group2',
        		'slug' => 'group2-and-slug',
                'is_open' => rand(0,1),
                'created_at' => Carbon::now()
        	],
        	[
        		'title' => 'Group3',
        		'slug' => 'group3-and-slug',
                'is_open' => rand(0,1),
                'created_at' => Carbon::now()
        	],
        	[
        		'title' => 'Group4',
        		'slug' => 'group4-and-slug',
                'is_open' => rand(0,1),
                'created_at' => Carbon::now()
        	],
        	[
        		'title' => 'Group5',
        		'slug' => 'group5-and-slug',
                'is_open' => rand(0,1),
                'created_at' => Carbon::now()
        	]
        ]);
    }
}