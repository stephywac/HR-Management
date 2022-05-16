<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    
    public function run()
    {
        App\Designation::truncate();
       
        App\Designation::create([
            'name' => 'Web Developer',
            'slug' => 'web_developer',
            'status'=>'1',
            'department_id'=>1
        ]);
        App\Designation::create([
            'name' => 'Web Designer',
            'slug' => 'web_designer',
            'status'=>'1',
            'department_id'=>2
        ]);
        App\Designation::create([
            'name' => 'Digital marketing',
            'slug' => 'tester',
            'status'=>1,
            'department_id'=>4
        ]);
        App\Designation::create([
            'name' => 'flutter ',
            'slug' => 'flutter',
            'status'=>'1',
            'department_id'=>3 
        ]);

    }
}
