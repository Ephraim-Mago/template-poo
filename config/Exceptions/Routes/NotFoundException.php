<?php

namespace Config\Exceptions\Routes;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function error404()
    {
        http_response_code(404);
        //require VIEW_PATH . 'errors/404.php';
        echo "La route n'existe pas";
        die;
    }
}