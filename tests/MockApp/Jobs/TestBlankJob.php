<?php

namespace Vivid\Foundation\Tests\MockApp\Jobs;

use Vivid\Foundation\Job;

class TestBlankJob extends Job {

    public function handle()
    {
        return 'TestBlankJob';
    }

}