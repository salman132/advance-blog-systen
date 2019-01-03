<?php

use Illuminate\Database\Seeder;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discussion1 = ['user_id'=> 1,'channel_id'=>1,'title'=>'Laravel Is good','slug'=>str_slug('Laravel Is good'),'content'=>'Write Something'];
        $discussion2 = ['user_id'=> 1,'channel_id'=>2,'title'=>'VueJs Is good','slug'=>str_slug('VueJs Is good'),'content'=>'Write Something'];

        \App\Discussion::create($discussion1);
        \App\Discussion::create($discussion2);
    }
}
