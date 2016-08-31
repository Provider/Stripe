<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\FetchCustomer;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class FetchCustomerTest extends PorterTest
{
    public function testFetchCustomer()
    {
        $customer = $this->porter->importOne(
            new ImportSpecification(new FetchCustomer(FixtureFactory::createCustomer()->getId()))
        );

        self::assertArrayHasKey('id', $customer);
        self::assertTrue(Customer::isValidIdentifier($customer['id']));
    }
}
