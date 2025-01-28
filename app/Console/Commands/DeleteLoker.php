<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteLoker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-loker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus loker yang sudah lebih dari 7 hari';

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
        // Hapus loker yang sudah lebih dari 7 hari
        $loker = \App\Job::where('created_at', '<', now()->subDays(7))->get();

        foreach ($loker as $l) {
            // hard delete
            $l->forceDelete();
        }

        $this->info('Berhasil menghapus loker yang sudah lebih dari 7 hari');
    }
}
