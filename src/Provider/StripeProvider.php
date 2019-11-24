<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Connector\Connector;
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

    public static function buildApiUrl(string $url): string
    {
        return self::BASE_URL . $url;
    }

    public function getConnector(): Connector
    {
        return $this->connector;
    }
}
