<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Token;

class FetchToken extends AbstractStripeResource
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    protected function getResourcePath()
    {
        return "tokens/$this->token";
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }

    protected function serialize()
    {
        return [];
    }
}
