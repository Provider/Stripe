<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Type\StringType;

final class Card
{
    /** @var string */
    private $number;

    /** @var string */
    private $cvc;

    /** @var int */
    private $expiryMonth;

    /** @var int */
    private $expiryYear;

    public function __construct($number, $expiryMonth, $expiryYear, $cvc = null)
    {
        $this->setNumber($number);
        $this->setExpiryMonth($expiryMonth);
        $this->setExpiryYear($expiryYear);
        $this->setCvc($cvc);
    }

    public function serialize()
    {
        return [
            'card[number]' => $this->getNumber(),
            'card[cvc]' => $this->getCvc(),
            'card[exp_month]' => $this->getExpiryMonth(),
            'card[exp_year]' => $this->getExpiryYear(),
        ];
    }

    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 'card_');
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    private function setNumber($number)
    {
        $this->number = "$number";
    }

    /**
     * @return string
     */
    public function getCvc()
    {
        return $this->cvc;
    }

    /**
     * @param string $cvc
     */
    public function setCvc($cvc)
    {
        $this->cvc = "$cvc";
    }

    /**
     * @return int
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * @param int $expiryMonth
     */
    private function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth|0;
    }

    /**
     * @return int
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * @param int $expiryYear
     */
    private function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear|0;
    }
}
