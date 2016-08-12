<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\StripeToken;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;
use ScriptFUSION\Porter\Specification\ImportSpecification;

final class StripeTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testImport()
    {
        $porter = (new Porter)->registerProvider((new StripeProvider)->setApiKey($_SERVER['STRIPE_API_KEY']));

        $results = $porter->import(new ImportSpecification(new StripeToken(new TestCard)));

        self::assertArrayHasKey('id', $result = $results->current());
        self::assertStringStartsWith('tok_', $result['id']);
    }
}
