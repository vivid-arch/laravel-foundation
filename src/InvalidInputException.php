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

use Exception;
use Illuminate\Validation\Validator as IlluminateValidator;

/**
 * An exception class that supports validators by extracting their messages
 * when given, or an array of messages as strings.
 */
class InvalidInputException extends Exception
{
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        if ($message instanceof IlluminateValidator) {
            $message = $message->messages()->all();
        }

        if (is_array($message)) {
            $message = implode("\n", $message);
        }

        parent::__construct($message, $code, $previous);
    }
}
