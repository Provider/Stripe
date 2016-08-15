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
     * @return array
     */
    abstract protected function getPayload();

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
                ->setMethod('POST')
                ->setContent(http_build_query($this->getPayload()))
        );

        yield json_decode($data, true);
    }
}
