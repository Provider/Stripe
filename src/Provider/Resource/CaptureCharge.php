<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Charge;

class CaptureCharge extends AbstractStripeResource
{
    private $charge;

    /**
     * @param Charge $charge
     */
    public function __construct(Charge $charge)
    {
        $this->charge = "$charge";
    }

    protected function getResourcePath()
    {
        return "charges/$this->charge/capture";
    }

    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function serialize()
    {
        return [];
    }
}
