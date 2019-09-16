<?php

/*
 * This file is part of the vivid-foundation project.
 *
 * Copyright for portions of project lucid-foundation are held by VineLab, 2016 as part of Lucid Architecture.
 * All other copyright for project Vivid Architecture are held by Meletios Flevarakis, 2019.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vivid\Foundation;

use Vivid\Foundation\Events\JobStarted;
use Vivid\Foundation\Events\OperationStarted;
use ReflectionClass;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Domains\Queue\DefaultQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

trait JobDispatcherTrait
{
    /**
     * beautifier function to be called instead of the
     * laravel function dispatchFromArray.
     * When the $arguments is an instance of Request
     * it will call dispatchFrom instead.
     *
     * @param string                         $job
     * @param array|\Illuminate\Http\Request $arguments
     * @param array                          $extra
     *
     * @return mixed
     */
    public function run($job, $arguments = [], $extra = [])
    {
        if ($arguments instanceof Request) {
            $result = $this->dispatch($this->marshal($job, $arguments, $extra));
        } else {
            if (!is_object($job)) {
                $job = $this->marshal($job, new Collection(), $arguments);
            }

            event(new JobStarted(get_class($job), $arguments));
            resolve('Vivid\Foundation\Instance')->addToJobStack(
                get_class($job)
            );

            $result = $this->dispatch($job, $arguments);
        }

        return $result;
    }

    /**
     * Run the given job in the given queue.
     *
     * @param string $job
     * @param array $arguments
     * @param string $queue
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function runInQueue($job, array $arguments = [], $queue = 'default')
    {
        // instantiate and queue the job
        $reflection = new ReflectionClass($job);
        $jobInstance = $reflection->newInstanceArgs($arguments);
        $jobInstance->onQueue((string) $queue);

        return $this->dispatch($jobInstance);
    }
}