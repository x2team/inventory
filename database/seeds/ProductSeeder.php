<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        // generate 36 dummy posts products
        $products = [];
        $faker = Factory::create('vi_VN');
        

        $count = 0;
        for ($i = 0; $i <= 10; $i++)
        {
            if($count == 10){
                DB::table('products')->insert($products);
                $products = [];
                $count = 0;
            }
            $products[] = [
                'category_id'      => rand(1,4),
                'product_name'     => $faker->name,
                'product_code'     => $faker->ean8,
                'root'             => $faker->postcode,
                'buying_price'     => $faker->randomNumber(5),
                'selling_price'    => $faker->randomNumber(5),
                'supplier_id'      => rand(1,4),
                'buying_date'      => $faker->date($format = 'd-m-Y', $max = 'now'),
                'image'            => '',
                'product_quantity' =>  rand(3,10),
                'created_at' => Carbon::now()->subDay(rand(6, 10))->subHours(rand(1, 5)),
                'updated_at' => Carbon::now()->subDay(rand(1, 5))->subHours(rand(1, 5)),

            ];
            $count ++;
            
        }
    }
}
