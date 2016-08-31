<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Card;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\FetchToken;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class FetchTokenTest extends PorterTest
{
    public function testFetchToken()
    {
        $token = $this->porter->importOne(new ImportSpecification(new FetchToken(FixtureFactory::createToken())));

        self::assertArrayHasKey('id', $token);
        self::assertTrue(Token::isValidIdentifier($token['id']));

        self::assertArrayHasKey('card', $token);
        self::assertTrue(Card::isValidIdentifier($token['card']['id']));
    }
}
