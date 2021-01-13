<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class NotFoundException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('exception.record_not_found');
        }

        if (!$code) {
            $code = Response::HTTP_NOT_FOUND;
        }
        parent::__construct($message, $code);
    }
}
