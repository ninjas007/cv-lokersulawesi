<?php

namespace App\Console\Commands;

use App\Job;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SaveLoker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-loker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save loker dari scraping to database';

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
        try {
            app(\App\Http\Controllers\ScrapController::class)->jobstreet();
            // app(\App\Http\Controllers\ScrapController::class)->glints();
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return $e->getMessage();
            }

            Log::error($e->getMessage());
        }
    }
}
