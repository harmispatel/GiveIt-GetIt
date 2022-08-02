<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class RequirementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $requirement = [
            [
                'category_id'=>'1',
                'requirements'=>'1',
                'quantity' => '10',
                'user_id' => '1',
                'type' => 'Getit',
                'status' => 'process',
                'is_active' => '1',
                'created_by' => '',
                'updated_by' => '',
                'deleted_by' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()],
        ];
    }
}
