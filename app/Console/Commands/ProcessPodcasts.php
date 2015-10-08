<?php

namespace App\Console\Commands;

use App\PodcastProcessor;
use Illuminate\Console\Command;

class ProcessPodcasts extends Command
{

    protected $signature = 'podcast:import';

    protected $description = 'Add new podcasts.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $p = new PodcastProcessor();
        $p->addNewPodcasts();

    }
}
