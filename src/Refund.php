<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Refund
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var RefundStatus
     */
    private $status;

    public function __construct($id)
    {
        $this->setId($id);
    }

    public static function fromArray($refundProperties)
    {
        $refund = new self($refundProperties['id']);
        $refund->setAmount($refundProperties['amount']);
        $refund->setStatus(RefundStatus::memberByKey($refundProperties['status'], false));

        return $refund;
    }

    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 're_');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    private function setId($id)
    {
        if (!self::isValidIdentifier($id)) {
            throw new InvalidIdentifierException("Invalid refund identifier: \"$id\".");
        }

        $this->id = "$id";
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    private function setAmount($amount)
    {
        $this->amount = $amount|0;
    }

    /**
     * @return RefundStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param RefundStatus $status
     */
    private function setStatus(RefundStatus $status)
    {
        $this->status = $status;
    }

    /**
     * Gets a value indicating whether the refund succeeded.
     *
     * @return bool True if the refund succeeded, otherwise false.
     */
    public function hasSucceeded()
    {
        return $this->status === RefundStatus::SUCCEEDED();
    }
}
