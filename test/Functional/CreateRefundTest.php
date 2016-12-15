<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateRefund;
use ScriptFUSION\Porter\Provider\Stripe\Refund;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateRefundTest extends PorterTest
{
    public function testRefundCapturedCharge()
    {
        $refund = Refund::fromArray($this->porter->importOne(new ImportSpecification(
            new CreateRefund($charge = FixtureFactory::createCapturedCharge())
        )));

        self::assertTrue($refund->hasSucceeded());
        self::assertSame($charge->getAmount(), $refund->getAmount());
    }

    public function testRefundUncapturedCharge()
    {
        $refund = Refund::fromArray($this->porter->importOne(new ImportSpecification(
            new CreateRefund($charge = FixtureFactory::createUncapturedCharge())
        )));

        self::assertTrue($refund->hasSucceeded());
        self::assertSame($charge->getAmount(), $refund->getAmount());
    }
}
