<?php

namespace App\Console;

use App\Models\Entity;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $entities = Entity::all();
            $hashtags = $entities->where('type', 'hashtag')->groupBy('body_plain');
            $hashtags = $hashtags->map(function ($hashtag) {
                $hashtag->tweet_count = $hashtag->count();
                return $hashtag;
            });
            $hashtags = $hashtags->sortByDesc(function ($hashtag) {
                return $hashtag->count();
            });
            // add tweet count to hashtag
            $hashtags = $hashtags->take(10);
            $hashtags = $hashtags->map(function ($hashtag) {
                return [
                    'body_plain' => $hashtag[0]->body_plain,
                    'tweet_count' => $hashtag->tweet_count,
                ];
            });
            $hashtags = $hashtags->toArray();
            // clear everything in trending_topics table
            \DB::table('trending_topics')->delete();
            // insert each hashtag into trending topics table
            foreach ($hashtags as $hashtag) {
                \DB::table('trending_topics')->insert([
                    'name' => $hashtag['body_plain'],
                    'tweet_count' => $hashtag['tweet_count'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            //log the hashtags to the console
            \Log::info($hashtags);
        }
        )->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
