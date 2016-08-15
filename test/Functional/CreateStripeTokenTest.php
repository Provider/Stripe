<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateStripeToken;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestCard;

final class CreateStripeTokenTest extends PorterTest
{
    public function testImport()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateStripeToken(new TestCard)));

        self::assertArrayHasKey('id', $result = $results->current());
        self::assertStringStartsWith('tok_', $result['id']);
    }
}
