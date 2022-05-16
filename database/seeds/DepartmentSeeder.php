<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Department::truncate();
       
        App\Department::create([
            'id'=>1,
            'department_name' => 'Backend Developement',
            'status'=>'1',
        ]);

        App\Department::create([
            'id'=>2,
            'department_name' => 'FrontEnd Developement',
            'status'=>'1',
        ]);
        App\Department::create([
            'id'=>3,
            'department_name' => 'Mobile Developement',
            'status'=>'1',
        ]);

        App\Department::create([
            'id'=>4,
            'department_name' => 'Digital  Marketing',
            'status'=>'1',
        ]);
    }
}
