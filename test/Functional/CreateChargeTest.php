<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCharge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\StripePaymentException;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateChargeTest extends PorterTest
{
    public function testChargeCard(): void
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createValidCard(), 1337, 'GBP'))
        ));
    }

    /**
     * Tests that when a charge is created for a non-chargeable card an unrecoverable exception is thrown.
     */
    public function testChargeNonChargeableCardFails(): void
    {
        $this->expectException(StripePaymentException::class);

        $this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createNonChargeableCard(), 1337, 'GBP'))
        );
    }

    public function testChargeToken(): void
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createToken(), 1338, 'USD'))
        ));
    }

    public function testChargeCustomer(): void
    {
        self::assertValidCharge($this->porter->importOne(
            new ImportSpecification(new CreateCharge(FixtureFactory::createCustomer(), 1339, 'JPY'))
        ));
    }

    public function testNonCapturingCharge(): void
    {
        self::assertFalse(FixtureFactory::createUncapturedCharge()->isCaptured());
    }

    private static function assertValidCharge(array $charge): void
    {
        self::assertArrayHasKey('id', $charge);
        self::assertTrue(Charge::isValidIdentifier($charge['id']));
        self::assertTrue($charge['captured']);
    }
}
