<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCustomer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestCard;

final class CreateCustomerTest extends PorterTest
{
    public function testCreateCustomerFromCard()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateCustomer(new TestCard)));

        self::assertValidCustomer($results->current());
    }

    public function testCreateCustomerFromToken()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateToken(new TestCard)));
        $token = $results->current()['id'];

        $results = $this->porter->import(new ImportSpecification(new CreateCustomer(new Token($token))));

        self::assertValidCustomer($results->current());
    }

    private static function assertValidCustomer(array $customer)
    {
        self::assertArrayHasKey('id', $customer);
        self::assertTrue(Customer::isValidIdentifier($customer['id']));
        self::assertArrayHasKey('sources', $customer);
        self::assertArrayHasKey('total_count', $sources = $customer['sources']);
        self::assertSame(1, $sources['total_count']);
    }
}
