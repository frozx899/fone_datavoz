<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->where('email', 'admin@gmail.com')->delete();

        DB::table('users')->insert(
            [   
                'username' =>'john',
                'name' => 'John Doe',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('adminadmin'),
                'type' => 'admin',
            ],
        );
    }
}
