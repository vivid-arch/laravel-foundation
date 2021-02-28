<?php

namespace Vivid\Foundation\Tests\MockApp\Jobs;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Vivid\Foundation\JobDispatcherTrait;
use Vivid\Foundation\Loggable;
use Vivid\Foundation\MarshalTrait;

/*
 * This class encapsulates the JobDispatcherTrait because $this->>run() is reserved inside the tests
 */
class JobContainerClass
{
    use MarshalTrait;
    use JobDispatcherTrait;
    use DispatchesJobs;
    use Loggable;
}