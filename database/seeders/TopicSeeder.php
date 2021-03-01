<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $baseTopics = ["Programming"=>"code", "Java"=>"code", "C/C++"=>"code", "C#"=>"code", "Laravel"=>"view_compact",
        "PHP"=>"code", "AI"=>"poll", "Machine Learning"=>"timeline", "Computer Vision"=>"poll", "Data Science"=>"timeline",
        "Science"=>"school", "Life"=>"face", "Art"=>"brush",
        "Adobe"=>"crop_original", "Design"=>"brush", "Photoshop"=>"crop_original", "Illustrator"=>"brush", "Premiere"=>"crop_original",
        "Maths"=>"import_contacts", "Physics"=>"import_contacts"];

        foreach ($baseTopics as $key => $value) {
            DB::table('topics')->insert([
                'name' => $key,
                'icon' => $value
            ]);
        }
    }
}
