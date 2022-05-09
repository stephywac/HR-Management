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
        App\User::create([
            'name' => 'stephy',
            'email' => 'stephy@webandcrafts.in',
            'password'=>Hash::make('1234567890'),
            'designation_id' => 0,
            'last_name' => 'Seban',
            'mobile' => '8281977485',
            'address' => 'test',
           
            'experience' => '1',
        ]);
    }
}
