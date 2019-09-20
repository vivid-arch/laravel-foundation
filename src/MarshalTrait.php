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

use ArrayAccess;
use Exception;
use ReflectionClass;
use ReflectionParameter;

trait MarshalTrait
{
    /**
     * Marshal a command from the given array accessible object.
     *
     * @param string       $command
     * @param \ArrayAccess $source
     * @param array        $extras
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    protected function marshal($command, ArrayAccess $source, array $extras = [])
    {
        $injected = [];

        $reflection = new ReflectionClass($command);

        if ($constructor = $reflection->getConstructor()) {
            $injected = array_map(function ($parameter) use ($command, $source, $extras) {
                return $this->getParameterValueForCommand($command, $source, $parameter, $extras);
            }, $constructor->getParameters());
        }

        return $reflection->newInstanceArgs($injected);
    }

    /**
     * Get a parameter value for a marshaled command.
     *
     * @param string               $command
     * @param \ArrayAccess         $source
     * @param \ReflectionParameter $parameter
     * @param array                $extras
     *
     * @throws \ReflectionException
     *
     * @return mixed
     */
    protected function getParameterValueForCommand($command, ArrayAccess $source,
        ReflectionParameter $parameter, array $extras = [])
    {
        if (array_key_exists($parameter->name, $extras)) {
            return $extras[$parameter->name];
        }

        if (isset($source[$parameter->name])) {
            return $source[$parameter->name];
        }

        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new Exception("Unable to map parameter [{$parameter->name}] to command [{$command}]");
    }
}
