<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Connector;

use ScriptFUSION\Porter\Net\Http\HttpConnector;

class StripeConnector extends HttpConnector
{
    /**
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct();

        $this->getOptions()->addHeader('Authorization: Basic ' . base64_encode($apiKey));
    }
}
