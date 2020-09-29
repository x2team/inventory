<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        $faker = Factory::create();


        $admin = 'Admin';
        $mod = 'Moderator';
        $author = 'Author';
        $member = 'Member';
        DB::table('users')->insert([
            [
                'name' => $admin,
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
