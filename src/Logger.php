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

use Log;

class Logger
{
    private $caller;

    public function __construct($caller)
    {
        $this->caller = $caller;
    }

    public function debug($message)
    {
        Log::debug(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function info($message)
    {
        Log::info(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function notice($message)
    {
        Log::notice(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function warning($message)
    {
        Log::warning(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function error($message)
    {
        Log::error(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function crititcal($message)
    {
        Log::crititcal(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function alert($message)
    {
        Log::alert(
            $this->prepareMessage($message, $this->caller)
        );
    }

    public function emergency($message)
    {
        Log::emergency(
            $this->prepareMessage($message, $this->caller)
        );
    }

    private function prepareMessage($message, $caller)
    {
        return "[$caller] $message";
    }
}
