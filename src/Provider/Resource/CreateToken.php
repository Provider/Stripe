<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;

class CreateToken extends AbstractStripeResource
{
    private $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function getResourcePath()
    {
        return 'tokens';
    }

    protected function serialize()
    {
        return $this->card->serialize();
    }
}
