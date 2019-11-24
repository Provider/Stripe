<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Connector\FetchExceptionHandler;

use ScriptFUSION\Porter\Connector\Recoverable\RecoverableException;
use ScriptFUSION\Porter\Connector\Recoverable\StatelessRecoverableExceptionHandler;
use ScriptFUSION\Porter\Net\Http\HttpServerException;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\StripePaymentException;

final class StripFetchExceptionHandler extends StatelessRecoverableExceptionHandler
{
    public function __construct()
    {
        parent::__construct(
            static function (RecoverableException $exception) {
                // Treat 402 as unrecoverable error.
                if ($exception instanceof HttpServerException && $exception->getResponse()->getStatusCode() === 402) {
                    $errorBody = json_decode($exception->getResponse()->getBody(), true)['error'];

                    throw new StripePaymentException(
                        $errorBody['message'],
                        $errorBody['type'],
                        $errorBody['code'],
                        isset($errorBody['param']) ? $errorBody['param'] : null,
                        $exception
                    );
                }
            }
        );
    }
}
