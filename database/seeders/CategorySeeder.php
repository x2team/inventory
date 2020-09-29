<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            [
                'category_name' => 'Computer',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'category_name' => 'Fashion',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'category_name' => 'Robot',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'category_name' => 'Other',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ]);
    }
}
