<?php

namespace App\Controllers;

use Config\Bases\BaseController;
use Config\Traits\Rendering;

abstract class Controller extends BaseController
{
    use Rendering;
}