<?php

namespace App\Controller;

use core\Renderer;

abstract class AbstractController
{
    public function __construct(
        protected Renderer $renderer
    )
    {
    }
}