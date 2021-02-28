<?php

namespace Vivid\Foundation\Tests\MockApp\Jobs;

use Vivid\Foundation\Job;

class TestReturnInputJob extends Job {

    private $input;

    function __construct($input)
    {
        $this->input = $input;
    }

    public function handle()
    {
        return $this->input;
    }

}