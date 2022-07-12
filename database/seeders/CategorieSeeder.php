<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $record = [
            ['name'=>'Food','status'=>'1'],
            ['name'=>'Toys','status'=>'1'],
            ['name'=>'Clothes','status'=>'1'],
            ['name'=>'Books','status'=>'1'],
            ['name'=>'Others','status'=>'1'],
            
            
        ];
         
        Category::insert($record);

    }
}
