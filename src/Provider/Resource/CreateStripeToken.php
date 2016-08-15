<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;

class CreateStripeToken extends AbstractStripeResource
{
    private $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    protected function getResourcePath()
    {
        return 'tokens';
    }

    protected function getPayload()
    {
        return $this->card->serialize();
    }
}
