<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;

class CreateCustomer extends AbstractStripeResource
{
    /** @var string|Card */
    private $source;

    public function __construct($source)
    {
        $this->source = $source instanceof Card ? $source : "$source";
    }

    protected function getResourcePath()
    {
        return 'customers';
    }

    protected function getPayload()
    {
        if ($this->source instanceof Card) {
            return $this->source->serialize();
        }

        return [
            'source' => $this->source,
        ];
    }
}
