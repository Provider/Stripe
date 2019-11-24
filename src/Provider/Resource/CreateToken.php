<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;

class CreateToken extends AbstractStripeResource
{
    private $card;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function getResourcePath(): string
    {
        return 'tokens';
    }

    protected function serialize(): array
    {
        return $this->card->serialize();
    }
}
