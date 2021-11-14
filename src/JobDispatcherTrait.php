<?php

/*
 * This file is part of the vivid-foundation project.
 *
 * Copyright for portions of project lucid-foundation are held by VineLab, 2016 as part of Lucid Architecture.
 * All other copyright for project Vivid Architecture are held by Meletios Flevarakis, 2021.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Vivid\Foundation;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use ReflectionClass;
use Vivid\Foundation\Contracts\Cacheable;
use Vivid\Foundation\Events\JobCacheHit;
use Vivid\Foundation\Events\JobCacheMiss;
use Vivid\Foundation\Events\JobCacheSet;
use Vivid\Foundation\Events\JobStarted;

trait JobDispatcherTrait
{
    /**
     * Beautifier function to be called instead of the
     * laravel function dispatchFromArray.
     * When the $arguments is an instance of Request
     * it will call dispatchFrom instead.
     *
     * @param string $jobClass
     * @param array $arguments
     * @param array $extra
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function run(string $jobClass, array $arguments = [], array $extra = [])
    {
        /** @var Job $job */
        $job = $this->marshal($jobClass, new Collection(), $arguments);

        Event::dispatch(new JobStarted(get_class($job), $job->redacted ? ['JOB_DATA_REDACTED'] : $arguments));

        resolve('Vivid\Foundation\Instance')->addToJobStack(
            get_class($job),
            (config('app.env') == 'production') ? null : $arguments
        );

        if ($job instanceof Cacheable) {
            if (Cache::has($job->getCacheKey())) {
                Event::dispatch(new JobCacheHit($jobClass, $job->getCacheKey()));
                return Cache::get($job->getCacheKey());
            }
            else {
                Event::dispatch(new JobCacheMiss($jobClass, $job->getCacheKey()));
            }
        }

        $response = $this->dispatch($job);

        if ($job instanceof Cacheable) {
            Cache::put($job->getCacheKey(), $response, $job->getCacheExpiration());
            Event::dispatch(new JobCacheSet($jobClass, $job->getCacheKey(), $response));
        }

        return $response;
    }

    /**
     * Beautifier wrapper to be used to conditionally
     * run a job without having to use ifs inside the feature.
     *
     * @return mixed|void
     * @throws \ReflectionException
     */
    public function runIf(bool $condition, string $job, array $arguments = [], array $extra = [])
    {
        if ($condition) {
            return $this->run($job, $arguments, $extra);
        }
    }

    /**
     * Beautifier wrapper to be used to conditionally
     * run a job without having to use ifs inside the feature.
     *
     * @return mixed|void
     * @throws \ReflectionException
     */
    public function runUnless(bool $condition, string $job, array $arguments = [], array $extra = [])
    {
        if (!$condition) {
            return $this->run($job, $arguments, $extra);
        }
    }

    /**
     * Run the given job in the given queue.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function runInQueue(string $job, array $arguments = [], string $queue = 'default')
    {
        // instantiate and queue the job
        $reflection = new ReflectionClass($job);
        $jobInstance = $reflection->newInstanceArgs($arguments);
        $jobInstance->onQueue((string) $queue); // @phpstan-ignore-line

        return $this->dispatch($jobInstance);
    }
}
