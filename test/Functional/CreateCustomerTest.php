<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCustomer;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateCustomerTest extends PorterTest
{
    public function testCreateCustomerFromCard(): void
    {
        self::assertValidCustomer($this->porter->importOne(
            new ImportSpecification(new CreateCustomer(FixtureFactory::createValidCard()))
        ));
    }

    public function testCreateCustomerFromToken(): void
    {
        self::assertValidCustomer($this->porter->importOne(
            new ImportSpecification(new CreateCustomer(FixtureFactory::createToken()))
        ));
    }

    private static function assertValidCustomer(array $customer): void
    {
        self::assertArrayHasKey('id', $customer);
        self::assertTrue(Customer::isValidIdentifier($customer['id']));
        self::assertArrayHasKey('sources', $customer);
        self::assertArrayHasKey('total_count', $sources = $customer['sources']);
        self::assertSame(1, $sources['total_count']);
    }
}
