<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $recode = [
            ['name'=>'Food','status'=>''],
            ['name'=>'Toys','status'=>''],
            ['name'=>'Clothes','status'=>''],
            ['name'=>'Books','status'=>''],
            ['name'=>'Others','status'=>''],
            
            
        ];
         
        categories::insert($recode);

    }
}
