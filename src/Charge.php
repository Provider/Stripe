<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Type\StringType;

final class Charge
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
     * @var bool
     */
    private $captured;

    public function __construct($id)
    {
        $this->setId($id);
    }

    public function __toString()
    {
        return "$this->id";
    }

    /**
     * @param array $chargeProperties
     *
     * @return Charge
     */
    public static function fromArray(array $chargeProperties)
    {
        $charge = new self($chargeProperties['id']);
        $charge->setAmount($chargeProperties['amount']);
        $charge->setCaptured($chargeProperties['captured']);

        return $charge;
    }

    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 'ch_');
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
            throw new InvalidIdentifierException("Invalid charge identifier: \"$id\".");
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
     * @return bool
     */
    public function isCaptured()
    {
        return $this->captured;
    }

    /**
     * @param bool $captured
     */
    private function setCaptured($captured)
    {
        $this->captured = (bool)$captured;
    }
}
