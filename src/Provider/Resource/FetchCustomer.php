<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

class FetchCustomer extends AbstractStripeResource
{
    private $customerId;

    public function __construct($customerId)
    {
        $this->customerId = (string)$customerId;
    }

    protected function getResourcePath(): string
    {
        return "customers/$this->customerId";
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
