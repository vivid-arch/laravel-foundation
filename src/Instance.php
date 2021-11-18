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

class Instance
{
    /**
     * @var string|float
     */
    protected $startTime;
    protected ?string $controller = null;
    protected ?string $feature = null;
    protected array $jobs = [];

    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    public function setController(string $controller): void
    {
        $this->controller = $controller;
    }

    public function setFeature(string $feature): void
    {
        $this->feature = $feature;
    }

    /**
     * @param mixed $arguments
     */
    public function addToJobStack(string $job, $arguments = null): void
    {
        array_push($this->jobs, [
            'fqn'  => $job,
            'time' => microtime(true),
            'data' => $arguments,
        ]);
    }

    public function controller(): string
    {
        return $this->controller;
    }

    public function feature(): string
    {
        return $this->feature;
    }

    public function jobs(): array
    {
        return $this->jobs;
    }

    public function toArray(): array
    {
        return [
            'start'      => $this->startTime,
            'controller' => $this->controller,
            'feature'    => $this->feature,
            'jobs'       => $this->jobs,
        ];
    }
}
