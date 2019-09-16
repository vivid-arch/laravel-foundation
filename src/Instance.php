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

/**
 * @author Meletios Flevarakis <m.flevarakis@gmail.com>
 */
class Instance {

    protected $controller;
    protected $feature;
    protected $jobs = [];

    /**
     * @param string $controller
     */
    public function setController(string $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param string $feature
     */
    public function setFeature(string $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param string $job
     */
    public function addToJobStack(string $job)
    {
        array_push($this->jobs, $job);
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getFeature()
    {
        return $this->feature;
    }

    /**
     * @return array
     */
    public function getJobs(): array
    {
        return $this->jobs;
    }

}