<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCharge;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateChargeTest extends PorterTest
{
    public function testChargeCard()
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createCard(), 1337, 'GBP'))
        ));
    }

    public function testChargeToken()
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createToken(), 1338, 'USD'))
        ));
    }

    public function testChargeCustomer()
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createCustomer(), 1339, 'JPY'))
        ));
    }

    public function testNonCapturingCharge()
    {
        self::assertFalse(FixtureFactory::createUncapturedCharge()->isCaptured());
    }

    private static function assertValidCharge(array $charge)
    {
        self::assertArrayHasKey('id', $charge);
        self::assertTrue(Charge::isValidIdentifier($charge['id']));
    }
}
