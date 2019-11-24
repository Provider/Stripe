<?php
declare(strict_types=1);

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

    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function getResourcePath(): string
    {
        return 'customers';
    }

    protected function serialize(): array
    {
        if ($this->source instanceof Card) {
            return $this->source->serialize();
        }

        return [
            'source' => (string)$this->source,
        ];
    }
}
