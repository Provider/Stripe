<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Provider\AbstractProvider;
use ScriptFUSION\Porter\Provider\Resource\Resource;

final class StripeProvider extends AbstractProvider
{
    const BASE_URL = 'https://api.stripe.com/v1/';

    private $options;

    public function __construct(HttpConnector $connector = null)
    {
        parent::__construct($connector = $connector ?: new HttpConnector);

        $connector->setBaseUrl(self::BASE_URL);

        $this->options = new StripeOptions;
    }

    public function fetch(Resource $resource)
    {
        if (!$resource instanceof StripeResource) {
            throw new IncompatibleResourceException('Resource must implement StripeResource.');
        }

        $resource->setOptions($this->options->toHttpOptions());

        return parent::fetch($resource);
    }

    public function setApiKey($apiKey)
    {
        $this->options->setApiKey($apiKey);

        return $this;
    }
}
