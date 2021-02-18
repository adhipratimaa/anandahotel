<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('settings')->delete();
        $data=new App\Models\Setting([
        	'facebook'=>'',
        	'twitter'=>'',
        	'email'=>'',
        	'address'=>'',
        	'phone'=>''
        	]);
        $data->save();
    }
}
