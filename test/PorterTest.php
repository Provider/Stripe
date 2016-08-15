<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;

abstract class PorterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = (new Porter)
            ->registerProvider((new StripeProvider)->setApiKey($_SERVER['STRIPE_API_KEY']));
    }
}
