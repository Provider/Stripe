<?php
declare(strict_types=1);

namespace ScriptFUSIONTest\Porter\Provider\Stripe\Functional;

use ScriptFUSION\Porter\Provider\Stripe\Charge;
use ScriptFUSION\Porter\Provider\Stripe\Provider\Resource\CaptureCharge;
use ScriptFUSION\Porter\Specification\ImportSpecification;
use ScriptFUSIONTest\Porter\Provider\Stripe\FixtureFactory;
use ScriptFUSIONTest\Porter\Provider\Stripe\PorterTest;

final class CaptureChargeTest extends PorterTest
{
    public function testCaptureCharge(): void
    {
        $uncapturedCharge = FixtureFactory::createUncapturedCharge();
        self::assertFalse($uncapturedCharge->isCaptured());

        $capturedCharge = Charge::fromArray(
            $this->porter->importOne(new ImportSpecification(new CaptureCharge($uncapturedCharge)))
        );
        self::assertTrue($capturedCharge->isCaptured());
        self::assertSame($uncapturedCharge->getAmount(), $capturedCharge->getAmount());
    }
}
