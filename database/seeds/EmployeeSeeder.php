<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete();

        // generate 36 dummy posts employees
        $employees = [];
        $faker = Factory::create('vi_VN');
        

        $count = 0;
        for ($i = 0; $i <= 10; $i++)
        {
            if($count == 10){
                DB::table('employees')->insert($employees);
                $employees = [];
                $count = 0;
            }
            $employees[] = [
                'name'       => $faker->name,
                'email'     => $faker->freeEmail,
                'address'      => $faker->streetAddress,
                'salary'   => $faker->ean8,
                'joining_date'      => $faker->date($format = 'd-m-Y', $max = 'now'),
                'nid'       => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'phone'       => $faker->phoneNumber,
                'photo'       => 'employee/1597940930.jpeg',
                'created_at' => Carbon::now()->subDay(rand(6, 10))->subHours(rand(1, 5)),
                'updated_at' => Carbon::now()->subDay(rand(1, 5))->subHours(rand(1, 5)),
            ];
            $count ++;
            
        }
    }
}
