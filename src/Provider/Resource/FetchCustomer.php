<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

class FetchCustomer extends AbstractStripeResource
{
    private $customerId;

    public function __construct($customerId)
    {
        $this->customerId = (string)$customerId;
    }

    protected function getResourcePath()
    {
        return "customers/$this->customerId";
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }

    protected function serialize()
    {
        return [];
    }
}
