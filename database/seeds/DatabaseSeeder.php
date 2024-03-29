<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PostsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(TagsTableSeeder::class);
         $this->call(CommentsTableSeeder::class);
         $this->call(GroupsTableSeeder::class);
         $this->call(BoardsTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(ChaptersTableSeeder::class);
         $this->call(PagesTableSeeder::class);
         $this->call(StaffsTableSeeder::class);


    }
}
