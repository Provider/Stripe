<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;
use ScriptFUSIONTest\Porter\Provider\Stripe\TestCard;

final class CreateTokenTest extends PorterTest
{
    public function testCreateToken()
    {
        $results = $this->porter->import(new ImportSpecification(new CreateToken(new TestCard)));

        self::assertArrayHasKey('id', $result = $results->current());
        self::assertTrue(Token::isValidIdentifier($result['id']));
    }
}
