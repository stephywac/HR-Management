<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        App\User::create([
            'name' => 'stephy',
            'email' => 'stephy@webandcrafts.in',
            'password'=>Hash::make('1234567890'),
            'username' => 'admin123',
            'department_id' => null,
            'designation_id' => null,
            'last_name' => 'Seban',
            'mobile' => '8281977485',
            'address' => 'test',
            'experience' => '1',
            'user_type'=>1
        ]);
    }
}
