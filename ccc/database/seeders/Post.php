<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class Post extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,10) as $value)
        {
            DB::table('posts')->insert([
                'commentId' =>'1',
                'name' =>$faker->name,
            ]);
        }
        // DB::table('posts')->insert([
        //     'commentId'=>Str::random(10),
        //     'name'=>Str::random(10)
        // ]);
        // DB::table('posts')->insert([
        //     'commentId'=>2,
        //     'name'=>'fb'
        // ]);
    }
}
