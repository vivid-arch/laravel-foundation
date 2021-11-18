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
    private string $channel;

    public function __construct(string $channel)
    {
        $this->channel = $channel;
    }

    public function setCaller(string $caller): Logger
    {
        $this->caller = $caller;
        return $this;
    }

    /**
     * Log a Debug message.
     */
    public function debug(string $message): void
    {
        Log::channel($this->channel)->debug(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Info message.
     */
    public function info(string $message): void
    {
        Log::channel($this->channel)->info(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Notice message.
     */
    public function notice(string $message): void
    {
        Log::channel($this->channel)->notice(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Warning message.
     */
    public function warning(string $message): void
    {
        Log::channel($this->channel)->warning(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Error message.
     */
    public function error(string $message): void
    {
        Log::channel($this->channel)->error(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log a Critical message.
     */
    public function critical(string $message): void
    {
        Log::channel($this->channel)->critical(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Alert message.
     */
    public function alert(string $message): void
    {
        Log::channel($this->channel)->alert(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Log an Emergency message.
     */
    public function emergency(string $message): void
    {
        Log::channel($this->channel)->emergency(
            $this->prepareMessage($message, $this->caller)
        );
    }

    /**
     * Format the message.
     */
    private function prepareMessage(string $message, string $caller): string
    {
        return "[$caller] $message";
    }
}
