<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Refund
{
    private $id;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var RefundStatus
     */
    private $status;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    public static function fromArray($refundProperties): Refund
    {
        $refund = new self($refundProperties['id']);
        $refund->setAmount($refundProperties['amount']);
        $refund->setStatus(RefundStatus::memberByKey($refundProperties['status'], false));

        return $refund;
    }

    public static function isValidIdentifier(string $id): bool
    {
        return StringType::startsWith($id, 're_');
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function setId(string $id): void
    {
        if (!self::isValidIdentifier($id)) {
            throw new InvalidIdentifierException("Invalid refund identifier: \"$id\".");
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

    public function getStatus(): RefundStatus
    {
        return $this->status;
    }

    private function setStatus(RefundStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * Gets a value indicating whether the refund succeeded.
     *
     * @return bool True if the refund succeeded, otherwise false.
     */
    public function hasSucceeded(): bool
    {
        return $this->status === RefundStatus::SUCCEEDED();
    }
}
