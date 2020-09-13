<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = [
            [
                'name'=>'Utpala',
                'email'=>'info@anandahotel.com',
                'password'=>bcrypt('Ananda123'),
               
            ],
            [
                'name'=>'user',
                'email'=>'info@user.com',
                'password'=>bcrypt('secret'),
                           ]
            ];
        \App\User::insert($data);
    }
}
