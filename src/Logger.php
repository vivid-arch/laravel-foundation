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

use Illuminate\Support\Facades\Log;

class Logger
{
    private string $caller;

    /**
     * Logger constructor.
     *
     * @param string $caller
     */
    public function __construct(string $caller)
    {
        $this->caller = $caller;
    }

    /**
     * Log a Debug message.
     *
     * @param string $message
     */
    public function debug(string $message): void
    {
        Log::debug(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Info message.
     *
     * @param string $message
     */
    public function info(string $message): void
    {
        Log::info(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Notice message.
     *
     * @param string $message
     */
    public function notice(string $message): void
    {
        Log::notice(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Warning message.
     *
     * @param string $message
     */
    public function warning(string $message): void
    {
        Log::warning(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Error message.
     *
     * @param string $message
     */
    public function error(string $message): void
    {
        Log::error(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Critical message.
     *
     * @param string $message
     */
    public function critical(string $message): void
    {
        Log::critical(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Alert message.
     *
     * @param string $message
     */
    public function alert(string $message): void
    {
        Log::alert(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Emergency message.
     *
     * @param string $message
     */
    public function emergency(string $message): void
    {
        Log::emergency(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Format the message.
     *
     * @param string $message
     * @param string $caller
     *
     * @return string
     */
    private function prepareMessage(string $message, string $caller)
    {
        return "[$caller] $message";
    }
}
