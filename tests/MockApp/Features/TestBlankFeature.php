<?php

namespace Vivid\Foundation\Tests\MockApp\Features;

use Vivid\Foundation\Feature;

class TestBlankFeature extends Feature
{
    public function handle()
    {
        return 'TestBlankFeature';
    }
}
