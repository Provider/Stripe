<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Connector\RecoverableConnectorException;
use ScriptFUSION\Porter\Net\Http\HttpServerException;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;
use ScriptFUSION\Porter\Provider\Stripe\Connector\StripeConnector;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;

abstract class AbstractStripeResource implements ProviderResource
{
    /**
     * @return string
     */
    abstract protected function getResourcePath();

    /**
     * @return string
     */
    abstract protected function getHttpMethod();

    /**
     * @return array
     */
    abstract protected function serialize();

    public function getProviderClassName()
    {
        return StripeProvider::class;
    }

    public function fetch(ImportConnector $connector)
    {
        /** @var StripeConnector $wrappedConnector */
        $wrappedConnector = $connector->getWrappedConnector();
        $wrappedConnector->getOptions()
            ->setMethod($this->getHttpMethod())
            ->setContent(http_build_query($this->serialize()))
        ;

        $connector->setExceptionHandler(function (RecoverableConnectorException $exception) {
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
        });

        $data = $connector->fetch(StripeProvider::buildApiUrl($this->getResourcePath()));

        yield json_decode($data, true);
    }
}
