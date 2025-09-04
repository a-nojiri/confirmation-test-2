<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['春','夏','秋','冬']as $name){
           Season::firstOrCreate(['name' => $name]); 
           }
    }
}
