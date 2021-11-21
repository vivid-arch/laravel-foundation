<?php

namespace Vivid\Foundation;

use Illuminate\Foundation\Bus\DispatchesJobs;

class VividJobRunner {
    use MarshalTrait;
    use DispatchesJobs;
    use JobDispatcherTrait;
}