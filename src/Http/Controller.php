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

namespace Vivid\Foundation\Http;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Vivid\Foundation\ServesFeaturesTrait;

class Controller extends BaseController
{
    use ValidatesRequests;
    use ServesFeaturesTrait;

    public function __construct()
    {
        resolve('Vivid\Foundation\Instance')->setController(
            get_class($this)
        );
    }
}
