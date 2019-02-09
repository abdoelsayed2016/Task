<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new \App\User();
        $user->name="admin";
        $user->email="admin@gmail.com";
        $user->role=1;
        $user->password=Hash::make('12345');
        $user->save();


    }
}
