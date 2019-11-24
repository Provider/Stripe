<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Charge;

class CaptureCharge extends AbstractStripeResource
{
    private $charge;

    public function __construct(Charge $charge)
    {
        $this->charge = (string)$charge;
    }

    protected function getResourcePath(): string
    {
        return "charges/$this->charge/capture";
    }

    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function serialize(): array
    {
        return [];
    }
}
