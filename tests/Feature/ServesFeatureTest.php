<?php

namespace Vivid\Foundation\Tests\Feature;

use Vivid\Foundation\ServesFeaturesTrait;
use Vivid\Foundation\Tests\MockApp\Features\TestBlankFeature;
use Vivid\Foundation\Tests\TestCase;

class ServesFeatureTest extends TestCase
{
    use ServesFeaturesTrait;

    /*
     * This function tests if a Feature will be dispatched and return back the correct string
     */
    public function test_serving_feature()
    {
        $out = $this->serve(TestBlankFeature::class);
        $this->assertEquals('TestBlankFeature', $out);
    }
}
