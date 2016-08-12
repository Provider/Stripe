<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpOptions;

final class StripeOptions
{
    /** @var string */
    private $apiKey;

    /**
     * @return HttpOptions
     */
    public function toHttpOptions()
    {
        return (new HttpOptions)->addHeader('Authorization: Basic ' . base64_encode($this->getApiKey()));
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = "$apiKey";
    }
}
