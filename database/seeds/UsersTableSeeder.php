<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'=>'1',
            'name'=>'Admin',
            'username'=>'admin01',
            'email'=>'admin094@gmail.com',
            'password'=>bcrypt('jahid094'),
        ]);
        DB::table('users')->insert([
            'role_id'=>'2',
            'name'=>'Author',
            'username'=>'author01',
            'email'=>'author094@gmail.com',
            'password'=>bcrypt('jahid094'),
        ]);
    }
}
