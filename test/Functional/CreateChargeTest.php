<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCharge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCustomer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestCard;

final class CreateChargeTest extends PorterTest
{
    public function testChargeCard()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateCharge(new TestCard, 1337, 'GBP')));

        self::assertValidCharge($results->current());
    }

    public function testChargeToken()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateToken(new TestCard)));
        $token = $results->current()['id'];

        $results = $this->porter->import(new ImportSpecification(new CreateCharge(new Token($token), 1338, 'USD')));

        self::assertValidCharge($results->current());
    }

    public function testChargeCustomer()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateCustomer(new TestCard)));
        $customerId = $results->current()['id'];

        $results = $this->porter->import(
            new ImportSpecification(new CreateCharge(new Customer($customerId), 1339, 'JPY'))
        );

        self::assertValidCharge($results->current());
    }

    private static function assertValidCharge(array $charge)
    {
        self::assertArrayHasKey('id', $charge);
        self::assertTrue(Charge::isValidIdentifier($charge['id']));
    }
}
