<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Token;

class FetchToken extends AbstractStripeResource
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    protected function getResourcePath(): string
    {
        return "tokens/$this->token";
    }

    protected function getHttpMethod(): string
    {
        return 'GET';
    }

    protected function serialize(): array
    {
        return [];
    }
}
