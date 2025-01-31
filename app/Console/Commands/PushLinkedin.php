<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PushLinkedin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push-linkedin';

    /**
     * The console command description.W
     *
     * @var string
     */
    protected $description = 'Command post to linkedin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $jobs = \App\Job::where('post_linkedin', 0)->orderBy('created_at', 'desc')->limit(5)->get();

        if (count($jobs) == 0) {
            return;
        }

        $this->info('Start post to linkedin');

        foreach ($jobs as $job) {
            try {
                app(\App\Http\Controllers\JobController::class)->getUserInfo();
                app(\App\Http\Controllers\JobController::class)->postToLinkedin($job);

                $job->post_linkedin = 1;
                $job->save();
            } catch (\Exception $e) {
                app(\App\Http\Controllers\JobController::class)->postToLinkedinWithoutDescription($job);
                $job->post_linkedin = 1;
                $job->save();

                $this->error($e->getMessage());
            }
        }

        $this->info('Post to linkedin success');
    }
}
