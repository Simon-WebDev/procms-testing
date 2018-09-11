<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->truncate();
    	DB::table('role_user')->truncate();
    	//create Admin Role
       $admin = new Role();
       $admin->name = 'admin';
       $admin->display_name = "Admin";
       $admin->save();

       //create Editor Role
       $editor = new Role();
       $editor->name = 'editor';
       $editor->display_name = "Editor";
       $editor->save();

       //create Author Role
       $author = new Role();
       $author->name = 'author';
       $author->display_name = "Author";
       $author->save();

       //Attach the role
       //first user as admin
       $user1 = User::find(1);
       $user1->attachRole($admin);

       //second user as editor
       $user2 = User::find(2);
       $user2->attachRole($editor);

       //third user as author
       $user3 = User::find(3);
       $user3->attachRole($author);
    }
}
