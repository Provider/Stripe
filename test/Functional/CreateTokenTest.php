<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\StripePaymentException;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CreateTokenTest extends PorterTest
{
    public function testCreateToken(): void
    {
        $token = $this->porter->importOne(new ImportSpecification(new CreateToken(FixtureFactory::createValidCard())));

        self::assertArrayHasKey('id', $token);
        self::assertTrue(Token::isValidIdentifier($token['id']));
    }

    /**
     * Tests that when a token cannot be created it is treated as a permanent failure and not retried.
     */
    public function testCreateTokenPermanentlyFails(): void
    {
        $this->expectException(StripePaymentException::class);

        $this->porter->importOne(new ImportSpecification(new CreateToken(FixtureFactory::createInvalidCard())));
    }
}
