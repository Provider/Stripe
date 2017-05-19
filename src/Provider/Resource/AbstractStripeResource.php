<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpServerException;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;
use ScriptFUSION\Porter\Provider\Resource\AbstractResource;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeOptions;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;

abstract class AbstractStripeResource extends AbstractResource
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

    public function fetch(Connector $connector, EncapsulatedOptions $options = null)
    {
        if (!$options instanceof StripeOptions) {
            throw new \InvalidArgumentException('Options must be an instance of StripeOptions.');
        }

        try {
            $data = $connector->fetch(
                $this->getResourcePath(),
                $options
                    ->toHttpOptions()
                    ->setMethod($this->getHttpMethod())
                    ->setContent(http_build_query($this->serialize()))
            );
        } catch (HttpServerException $exception) {
            // Treat 402 as unrecoverable error.
            if ($exception->getCode() === 402) {
                $errorBody = json_decode($exception->getBody(), true)['error'];
                throw new StripePaymentException(
                    $errorBody['message'],
                    $errorBody['type'],
                    $errorBody['code'],
                    isset($errorBody['param']) ? $errorBody['param'] : null,
                    $exception
                );
            }

            throw $exception;
        }

        yield json_decode($data, true);
    }
}
