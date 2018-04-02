<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use Psr\Container\ContainerInterface;
use ScriptFUSION\Porter\Porter;
use ScriptFUSION\Porter\Provider\Stripe\Card;
use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Connector\StripeConnector;
use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCharge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateCustomer;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CreateToken;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;
use ScriptFUSION\Porter\Provider\Stripe\Token;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSION\StaticClass;

final class FixtureFactory
{
    use StaticClass;

    public static function createPorter()
    {
        return new Porter(
            \Mockery::mock(ContainerInterface::class)
                ->shouldReceive('has')
                    ->with(StripeProvider::class)
                    ->andReturn(true)
                ->shouldReceive('get')
                    ->with(StripeProvider::class)
                    ->andReturn(new StripeProvider(
                        new StripeConnector($_SERVER['STRIPE_API_KEY'])
                    ))
                ->getMock()
        );
    }

    public static function createValidCard()
    {
        return self::createCard('4242424242424242');
    }

    public static function createInvalidCard()
    {
        return self::createCard('0');
    }

    public static function createNonChargeableCard()
    {
        return self::createCard('4000000000000002');
    }

    public static function createToken()
    {
        return new Token(
            self::createPorter()->importOne(new ImportSpecification(new CreateToken(self::createValidCard())))['id']
        );
    }

    public static function createCustomer()
    {
        return new Customer(
            self::createPorter()->importOne(new ImportSpecification(new CreateCustomer(self::createValidCard())))['id']
        );
    }

    public static function createCapturedCharge()
    {
        return Charge::fromArray(self::createPorter()->importOne(new ImportSpecification(
            new CreateCharge(self::createValidCard(), 100, 'GBP')
        )));
    }

    public static function createUncapturedCharge()
    {
        $createCharge = new CreateCharge(self::createValidCard(), 100, 'GBP');
        $createCharge->setCapture(false);

        return Charge::fromArray(self::createPorter()->importOne(new ImportSpecification($createCharge)));
    }

    private static function createCard($cardNumber)
    {
        return new Card($cardNumber, 12, date('Y') + 1, '123');
    }
}
