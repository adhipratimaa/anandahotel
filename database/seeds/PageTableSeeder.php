<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();
        $data = [
        	['title'=>'About us','slug'=>str_slug('about-us'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1','type'=>'about'],
        	['title'=>'Terms And Conditions','slug'=>str_slug('term-and-conditions'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1','type'=>'about'],
        	['title'=>'Privacy And Policy','slug'=>str_slug('privacy-and-policy'),'image'=>'','description'=>'','short_description'=>'','meta_description'=>'','meta_title'=>'','publish'=>'1','main'=>'1','type'=>'about']

            
        	];
        \App\Models\Page::insert($data);
    }
}
