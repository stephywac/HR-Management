<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Designation::create([
            'name' => 'Web Developer',
            'slug' => 'web_developer',
            'status'=>'1'
        ]);
        App\Designation::create([
            'name' => 'Web Designer',
            'slug' => 'web_designer',
            'status'=>'1'
        ]);
        App\Designation::create([
            'name' => 'Tester',
            'slug' => 'tester',
            'status'=>'1'
        ]);
        App\Designation::create([
            'name' => 'Seo ',
            'slug' => 'seo',
            'status'=>'1'
        ]);

    }
}
