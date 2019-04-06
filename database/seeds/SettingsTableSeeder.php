<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //table reset
        DB::table('settings')->truncate();
        
    	$faker = Factory::create();
        DB::table('settings')->insert([
        	'site_name' =>'default_site_name',
        	'site_phone' =>'010-123-5678',
        	'site_email' => 'company@company.com',
        	'site_address' =>'서울특별시 종로구 청와대로',
        	'site_agreement' => $faker->paragraphs(6, true),
        	'site_privacy' => $faker->paragraphs(6, true),
        	'created_at' => Carbon::now()

        ]);
    }
}
