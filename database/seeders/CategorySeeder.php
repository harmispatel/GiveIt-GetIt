<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class CategorySeeder extends Seeder
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
            ['name'=>'Food','status'=>'1','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name'=>'Toys','status'=>'1','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name'=>'Clothes','status'=>'1','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            ['name'=>'Books','status'=>'1','created_at' => Carbon::now(),'updated_at' => Carbon::now()],
            
            
        ];
         
        Category::insert($record);

    }
}
