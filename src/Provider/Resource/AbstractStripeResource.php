<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpOptions;
use ScriptFUSION\Porter\Provider\Resource\AbstractResource;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;

abstract class AbstractStripeResource extends AbstractResource implements StripeResource
{
    /** @var HttpOptions */
    protected $options;

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

    public function setOptions(HttpOptions $options)
    {
        $this->options = $options;
    }

    public function fetch(Connector $connector)
    {
        $data = $connector->fetch(
            $this->getResourcePath(),
            $this->options
                ->setMethod($this->getHttpMethod())
                ->setContent(http_build_query($this->serialize()))
        );

        yield json_decode($data, true);
    }
}
