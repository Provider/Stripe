<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Card
{
    private $number;

    private $cvc;

    private $expiryMonth;

    private $expiryYear;

    public function __construct(string $number, int $expiryMonth, int $expiryYear, string $cvc = '')
    {
        $this->setNumber($number);
        $this->setExpiryMonth($expiryMonth);
        $this->setExpiryYear($expiryYear);
        $this->setCvc($cvc);
    }

    public function serialize(): array
    {
        return [
            'card[number]' => $this->getNumber(),
            'card[cvc]' => $this->getCvc(),
            'card[exp_month]' => $this->getExpiryMonth(),
            'card[exp_year]' => $this->getExpiryYear(),
        ];
    }

    public static function isValidIdentifier($id): bool
    {
        return StringType::startsWith($id, 'card_');
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    private function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function getCvc(): string
    {
        return $this->cvc;
    }

    public function setCvc(string $cvc): void
    {
        $this->cvc = $cvc;
    }

    public function getExpiryMonth(): int
    {
        return $this->expiryMonth;
    }

    private function setExpiryMonth(int $expiryMonth): void
    {
        $this->expiryMonth = $expiryMonth;
    }

    public function getExpiryYear(): int
    {
        return $this->expiryYear;
    }

    private function setExpiryYear(int $expiryYear): void
    {
        $this->expiryYear = $expiryYear;
    }
}
