<?php


namespace App\Exceptions;


use Illuminate\Http\Response;

class BadRequestException extends AbstractException
{
    public function __construct($message = '', $code = null)
    {
        if (!$message) {
            $message = __('exception.bad_request');
        }

        if (!$code) {
            $code = Response::HTTP_BAD_REQUEST;
        }
        parent::__construct($message, $code);
    }
}
