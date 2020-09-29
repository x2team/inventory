<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->delete();
        
        
        
        

        
        // generate 36 dummy posts employees
        $suppliers = [];
        $faker = Factory::create('vi_VN');
        

        $count = 0;
        for ($i = 0; $i <= 4; $i++)
        {
            if($count == 2){
                DB::table('suppliers')->insert($suppliers);
                $suppliers = [];
                $count = 0;
            }
            $suppliers[] = [
                'name'       => $faker->company,
                'email'     => $faker->freeEmail,
                'phone'      => $faker->phoneNumber,
                'address'   => $faker->address,
                'photo'      => '',
                'shopname'       => $faker->jobTitle,
                'created_at' => Carbon::now()->subDay(rand(6, 10))->subHours(rand(1, 5)),
                'updated_at' => Carbon::now()->subDay(rand(1, 5))->subHours(rand(1, 5)),
            ];
            $count ++;
            
        }
    }
}
