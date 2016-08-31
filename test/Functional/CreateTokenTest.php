<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateTokenTest extends PorterTest
{
    public function testCreateToken()
    {
        $token = $this->porter->importOne(new ImportSpecification(new CreateToken(FixtureFactory::createCard())));

        self::assertArrayHasKey('id', $token);
        self::assertTrue(Token::isValidIdentifier($token['id']));
    }
}
