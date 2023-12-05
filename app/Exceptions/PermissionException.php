<?php

namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
    protected $message = 'Permission denied.';

    public function render($request)
    {
        return response()->json(['error' => $this->message], 403);
    }
}
