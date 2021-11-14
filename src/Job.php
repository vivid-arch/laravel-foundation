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

/**
 * An abstract Job to be extended by every job.
 * Note that this job is self-handling which
 * means it will NOT be queued, rather
 * will have the "handle()" method
 * called instead.
 */
abstract class Job
{
    use Loggable;

    /**
     * Hide the content of the parameters passed to Jobs from
     * appearing to logging and debugging systems like
     * Laravel Telescope. Used for sensitive data.
     *
     * @var bool
     */
    public bool $redacted = false;
}
