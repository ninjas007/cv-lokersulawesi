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
     * The console command description.
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
        $jobs = \App\Job::where('post_linkedin', 0)->orderBy('publish_on_date', 'desc')->limit(8)->get();

        if (count($jobs) == 0) {
            return;
        }

        app(\App\Http\Controllers\JobController::class)->getUserInfo();

        $this->info('Start post to linkedin');

        foreach ($jobs as $job) {
            $job->post_linkedin = 1;
            $job->save();
            try {
                app(\App\Http\Controllers\JobController::class)->postToLinkedin($job);
            } catch (\Exception $e) {
                // Menangani exception untuk setiap job tanpa menghentikan loop
                $this->error("Error posting job {$job->id}: " . $e->getMessage());
                continue; // Lanjutkan ke job berikutnya meskipun terjadi error
            }
        }

        $this->info('Post to linkedin success');
    }
}
