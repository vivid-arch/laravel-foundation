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

namespace Vivid\Foundation\Events;

class JobCacheMiss
{
    public string $name;
    public string $key;

    /**
     * JobCacheHit constructor.
     */
    public function __construct(string $name, string $key)
    {
        $this->name = $name;
        $this->key = $key;
    }
}
