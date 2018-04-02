<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpConnector;
use ScriptFUSION\Porter\Provider\Provider;
use ScriptFUSION\Porter\Provider\Stripe\Connector\StripeConnector;

final class StripeProvider implements Provider
{
    const BASE_URL = 'https://api.stripe.com/v1/';

    private $connector;

    public function __construct(StripeConnector $connector)
    {
        $this->connector = $connector;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public static function buildApiUrl($url)
    {
        return self::BASE_URL . $url;
    }

    /**
     * @return HttpConnector
     */
    public function getConnector()
    {
        return $this->connector;
    }
}
