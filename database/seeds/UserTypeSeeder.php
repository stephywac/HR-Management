<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->truncate();
        App\UserType::create([
            'type' => 'Admin',
        ]);
        App\UserType::create([
            'type' => 'User',
        ]);
    }
}
