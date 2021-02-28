<?php

namespace Vivid\Foundation\Tests\Feature;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Vivid\Foundation\Events\FeatureStarted;
use Vivid\Foundation\Events\JobStarted;
use Vivid\Foundation\ServesFeaturesTrait;
use Vivid\Foundation\Tests\MockApp\Features\TestBlankFeature;
use Vivid\Foundation\Tests\MockApp\Jobs\TestBlankJob;
use Vivid\Foundation\Tests\MockApp\Jobs\JobContainerClass;
use Vivid\Foundation\Tests\TestCase;

class EventBroadcastTest extends TestCase {

    use ServesFeaturesTrait;

    /*
     * This function tests if the FeatureStarted event is being fired
     */
    public function test_serve_feature_dispatches_event()
    {
        Event::fake();
        Config::set('vivid.broadcast_events', true);

        $this->serve(TestBlankFeature::class, []);

        Event::assertDispatched(FeatureStarted::class);
    }

    /*
     * This function tests if the JobStarted event is being fired
     */
    public function test_run_job_dispatches_event()
    {
        Event::fake();
        Config::set('vivid.broadcast_events', true);

        $c = new JobContainerClass;
        $c->run(TestBlankJob::class, []);

        Event::assertDispatched(JobStarted::class);
    }

}