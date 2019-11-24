<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use PHPUnit\Framework\TestCase;
use ScriptFUSION\Porter\Porter;

abstract class PorterTest extends TestCase
{
    /** @var Porter */
    protected $porter;

    protected function setUp()
    {
        $this->porter = FixtureFactory::createPorter();
    }
}
