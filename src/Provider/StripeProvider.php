<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Provider\AbstractProvider;

/**
 * @method StripeOptions getOptions
 */
final class StripeProvider extends AbstractProvider
{
    const BASE_URL = 'https://api.stripe.com/v1/';

    public function __construct(HttpConnector $connector = null)
    {
        parent::__construct($connector = $connector ?: new HttpConnector);
        $connector->setBaseUrl(self::BASE_URL);

        $this->setOptions(new StripeOptions);
    }

    public function setApiKey($apiKey)
    {
        $this->getOptions()->setApiKey($apiKey);

        return $this;
    }
}
