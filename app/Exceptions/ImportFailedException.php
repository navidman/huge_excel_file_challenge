<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ImportFailedException extends Exception
{
    public function __construct($message = "File import failed.", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
