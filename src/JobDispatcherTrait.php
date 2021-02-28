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

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ReflectionClass;
use Vivid\Foundation\Events\JobStarted;

trait JobDispatcherTrait
{
    /**
     * Beautifier function to be called instead of the
     * laravel function dispatchFromArray.
     * When the $arguments is an instance of Request
     * it will call dispatchFrom instead.
     *
     * @param string $job
     * @param array|\Illuminate\Http\Request $arguments
     * @param array $extra
     *
     * @return mixed
     */
    public function run(string $job, $arguments = [], $extra = [])
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
     * Beautifier wrapper to be used to conditionally
     * run a job without having to use ifs inside the feature.
     *
     * @param $condition
     * @param $job
     * @param array $arguments
     * @param array $extra
     *
     * @return mixed
     */
    public function runIf(bool $condition, $job, $arguments = [], $extra = [])
    {
        if ($condition) return $this->run($job, $arguments, $extra);
    }

    /**
     * Beautifier wrapper to be used to conditionally
     * run a job without having to use ifs inside the feature.
     *
     * @param bool $condition
     * @param $job
     * @param array $arguments
     * @param array $extra
     *
     * @return mixed
     */
    public function runUnless(bool $condition, $job, $arguments = [], $extra = [])
    {
        if (! $condition) return $this->run($job, $arguments, $extra);
    }

    /**
     * Run the given job in the given queue.
     *
     * @param string $job
     * @param array  $arguments
     * @param string $queue
     *
     * @throws \ReflectionException
     *
     * @return mixed
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
