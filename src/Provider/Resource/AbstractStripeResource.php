<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\ImportConnector;
use ScriptFUSION\Porter\Net\Http\HttpDataSource;
use ScriptFUSION\Porter\Provider\Resource\ProviderResource;
use ScriptFUSION\Porter\Provider\Resource\SingleRecordResource;
use ScriptFUSION\Porter\Provider\Stripe\Connector\FetchExceptionHandler\StripFetchExceptionHandler;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;

abstract class AbstractStripeResource implements ProviderResource, SingleRecordResource
{
    abstract protected function getResourcePath(): string;

    abstract protected function getHttpMethod(): string;

    abstract protected function serialize(): array;

    public function getProviderClassName(): string
    {
        return StripeProvider::class;
    }

    public function fetch(ImportConnector $connector): \Iterator
    {
        $connector->setRecoverableExceptionHandler(new StripFetchExceptionHandler);

        $data = $connector->fetch(
            (new HttpDataSource(
                StripeProvider::buildApiUrl($this->getResourcePath())
            ))
                ->setMethod($this->getHttpMethod())
                ->setBody(http_build_query($this->serialize()))
        );

        yield json_decode((string)$data, true);
    }
}
