<?php

use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->delete();
        $data = [
            [
                'name'=>'Deluxe',
                'slug'=>'deluxe',
                'room_capacity'=>3,
                'publish'=>1,
               
            ],
            [
                'name'=>'Suite',
                'slug'=>'suite',
                'publish'=>1,
                'room_capacity'=>4
            ]
            ];
        \App\Models\RoomType::insert($data);
    }
}
