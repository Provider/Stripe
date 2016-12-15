<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Charge;

class CreateRefund extends AbstractStripeResource
{
    /**
     * @var Charge
     */
    private $charge;

    public function __construct(Charge $charge)
    {
        $this->charge = $charge;
    }

    protected function getResourcePath()
    {
        return 'refunds';
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function serialize()
    {
        return [
            'charge' => "$this->charge",
        ];
    }
}
