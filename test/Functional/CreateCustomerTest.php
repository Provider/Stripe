<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCustomer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestCard;

final class CreateCustomerTest extends PorterTest
{
    public function testImportCard()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateCustomer(new TestCard)));

        self::assertArrayHasKey('id', $result = $results->current());
        self::assertStringStartsWith('cus_', $result['id']);
    }

    public function testImportToken()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateToken(new TestCard)));
        $token = $results->current()['id'];

        $results = $this->porter->import(new ImportSpecification(new CreateCustomer($token)));

        self::assertArrayHasKey('id', $result = $results->current());
        self::assertStringStartsWith('cus_', $result['id']);
    }
}
