<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpOptions;
use ScriptFUSION\Porter\Options\EncapsulatedOptions;

final class StripeOptions extends EncapsulatedOptions
{
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
        return $this->get('apiKey');
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->set('apiKey', "$apiKey");
    }
}
