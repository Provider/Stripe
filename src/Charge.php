<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Charge
{
    private $id;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var bool
     */
    private $captured;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    public function __toString()
    {
        return $this->id;
    }

    public static function fromArray(array $chargeProperties): Charge
    {
        $charge = new self($chargeProperties['id']);
        $charge->setAmount($chargeProperties['amount']);
        $charge->setCaptured($chargeProperties['captured']);

        return $charge;
    }

    public static function isValidIdentifier(string $id): bool
    {
        return StringType::startsWith($id, 'ch_');
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function setId(string $id): void
    {
        if (!self::isValidIdentifier($id)) {
            throw new InvalidIdentifierException("Invalid charge identifier: \"$id\".");
        }

        $this->id = $id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    private function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function isCaptured(): bool
    {
        return $this->captured;
    }

    private function setCaptured(bool $captured): void
    {
        $this->captured = $captured;
    }
}
