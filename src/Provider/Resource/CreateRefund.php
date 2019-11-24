<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Charge;

class CreateRefund extends AbstractStripeResource
{
    private $charge;

    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }

    protected function getResourcePath(): string
    {
        return 'refunds';
    }

    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function serialize(): array
    {
        return [
            'charge' => (string)$this->charge,
        ];
    }
}
