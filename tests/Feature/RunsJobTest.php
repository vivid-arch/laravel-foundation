<?php

namespace Vivid\Foundation\Tests\Feature;

use Illuminate\Support\Facades\Event;
use Vivid\Foundation\Tests\MockApp\Jobs\TestBlankJob;
use Vivid\Foundation\Tests\MockApp\Jobs\TestReturnInputJob;
use Vivid\Foundation\Tests\MockApp\Jobs\JobContainerClass;
use Vivid\Foundation\Tests\MockApp\Jobs\TestSilentJob;
use Vivid\Foundation\Tests\TestCase;

class RunsJobTest extends TestCase
{

    public function test_run_job()
    {
        $c = new JobContainerClass;
        $out = $c->run(TestBlankJob::class, []);

        $this->assertEquals('TestBlankJob', $out);
    }

    public function test_runIf_job()
    {
        $c = new JobContainerClass;
        $out1 = $c->runIf(true,TestBlankJob::class, []);
        $out2 = $c->runIf(false,TestBlankJob::class, []);

        $this->assertEquals('TestBlankJob', $out1);
        $this->assertEquals(null, $out2);
    }

    public function test_runUnless_job()
    {
        $c = new JobContainerClass;
        $out1 = $c->runUnless(true,TestBlankJob::class, []);
        $out2 = $c->runUnless(false,TestBlankJob::class, []);

        $this->assertEquals(null, $out1);
        $this->assertEquals('TestBlankJob', $out2);
    }

    public function test_job_received_input()
    {
        $c = new JobContainerClass;
        $out = $c->run(TestReturnInputJob::class, ['input' => 'this_is_a_test']);

        $this->assertEquals('this_is_a_test', $out);
    }

}