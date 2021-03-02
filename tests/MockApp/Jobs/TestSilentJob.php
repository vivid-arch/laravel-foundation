<?php

namespace Vivid\Foundation\Tests\MockApp\Jobs;

use Vivid\Foundation\Job;

class TestSilentJob extends Job
{
    public $silent = true;
    private $args;

    public function __construct($args)
    {
        $this->args = $args;
    }

    public function handle()
    {
        return 'TestSilentJob';
    }
}
