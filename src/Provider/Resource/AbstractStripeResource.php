<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\Connector;
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

        $data = $connector->fetch(
            $this->getResourcePath(),
            $options
                ->toHttpOptions()
                ->setMethod($this->getHttpMethod())
                ->setContent(http_build_query($this->serialize()))
        );

        yield json_decode($data, true);
    }
}
