<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $channel1= ['title'=> 'Laravel','slug'=>str_slug('Laravel')];
         $channel2= ['title'=> 'VueJs','slug'=>str_slug('VueJs')];
         $channel3=['title'=>'JavaScript','slug'=>str_slug('JavaScript')];
         $channel4=['title'=>'Spark','slug'=>str_slug('Spark')];

         Channel::create($channel1);
         Channel::create($channel2);
         Channel::create($channel3);
         Channel::create($channel4);
    }
}
