<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StartDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currencies = [
            ['id' => '1', 'name' => 'Gryvnya', 'code'=> 'UAH'],
            ['id' => '2', 'name' => 'Dollar USA', 'code'=> 'USD'],
            ['id' => '3', 'name' => 'Euro', 'code'=> 'EUR'],
        ];
        DB::table('currencies')->insert($currencies);


        for ($i = 1; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'currency_id' => rand(1, 3),
                'password' => Hash::make('1')
            ]);
        }
    }


}
