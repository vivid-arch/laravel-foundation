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

class Logger {

	private $caller;

    /**
     * Logger constructor.
     * @param $caller
     */
	public function __construct($caller)
	{
		$this->caller = $caller;
	}

    /**
     * Log a Debug message.
     *
     * @param $message
     */
	public function debug($message)
	{
		Log::debug(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log an Info message.
     *
     * @param $message
     */
	public function info($message)
	{
		Log::info(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log a Notice message.
     *
     * @param $message
     */
	public function notice($message)
	{
		Log::notice(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log a Warning message.
     *
     * @param $message
     */
	public function warning($message)
	{
		Log::warning(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log an Error message.
     *
     * @param $message
     */
	public function error($message)
	{
		Log::error(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log a Critical message.
     *
     * @param $message
     */
	public function critical($message)
	{
		Log::crititcal(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log an Alert message.
     *
     * @param $message
     */
	public function alert($message)
	{
		Log::alert(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Log an Emergency message.
     *
     * @param $message
     */
	public function emergency($message)
	{
		Log::emergency(
			$this->prepareMessage($message, $this->caller)
		);
	}

    /**
     * Format the message
     *
     * @param $message
     * @param $caller
     * @return string
     */
	private function prepareMessage($message, $caller)
	{
		return "[$caller] $message";
	}

}