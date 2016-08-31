<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Porter;

abstract class PorterTest extends \PHPUnit_Framework_TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = FixtureFactory::createPorter();
    }
}
