<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;
use ScriptFUSION\Porter\Provider\Stripe\Token;

class CreateCustomer extends AbstractStripeResource
{
    /** @var Token|Card */
    private $source;

    public function __construct($source)
    {
        if (!$source instanceof Token && !$source instanceof Card) {
            throw new \InvalidArgumentException('$source must be instance of Token or Card.');
        }

        $this->source = $source;
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function getResourcePath()
    {
        return 'customers';
    }

    protected function serialize()
    {
        if ($this->source instanceof Card) {
            return $this->source->serialize();
        }

        return [
            'source' => "$this->source",
        ];
    }
}
