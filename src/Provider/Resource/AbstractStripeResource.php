<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;
use ScriptFUSION\Porter\Provider\Stripe\Connector\FetchExceptionHandler\StripFetchExceptionHandler;
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

        $connector->setExceptionHandler(new StripFetchExceptionHandler);

        $data = $connector->fetch(StripeProvider::buildApiUrl($this->getResourcePath()));

        yield json_decode($data, true);
    }
}
