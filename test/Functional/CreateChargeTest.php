<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCharge;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestObjectFactory;

final class CreateChargeTest extends PorterTest
{
    public function testChargeCard()
    {
        $results = $this->porter->import(
            new ImportSpecification(new CreateCharge(TestObjectFactory::createCard(), 1337, 'GBP'))
        );

        self::assertValidCharge($results->current());
    }

    public function testChargeToken()
    {
        $results = $this->porter->import(
            new ImportSpecification(new CreateCharge(TestObjectFactory::createToken(), 1338, 'USD'))
        );

        self::assertValidCharge($results->current());
    }

    public function testChargeCustomer()
    {
        $results = $this->porter->import(
            new ImportSpecification(new CreateCharge(TestObjectFactory::createCustomer(), 1339, 'JPY'))
        );

        self::assertValidCharge($results->current());
    }

    private static function assertValidCharge(array $charge)
    {
        self::assertArrayHasKey('id', $charge);
        self::assertTrue(Charge::isValidIdentifier($charge['id']));
    }
}
