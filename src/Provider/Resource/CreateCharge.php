<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Provider\Stripe\Card;
use ScriptFUSION\Porter\Provider\Stripe\Customer;
use ScriptFUSION\Porter\Provider\Stripe\Token;

class CreateCharge extends AbstractStripeResource
{
    /** @var Token|Card */
    private $source;

    private $customer;

    private $amount;

    private $currency;

    /** @var bool */
    private $capture = true;

    /**
     * @param Token|Card|Customer $sourceOrCustomer
     * @param int $amount
     * @param string $currency
     */
    public function __construct($sourceOrCustomer, int $amount, string $currency)
    {
        if ($sourceOrCustomer instanceof Customer) {
            $this->setCustomer($sourceOrCustomer);
        } else {
            $this->setSource($sourceOrCustomer);
        }

        $this->setAmount($amount);
        $this->setCurrency($currency);
    }

    protected function getResourcePath(): string
    {
        return 'charges';
    }

    protected function getHttpMethod(): string
    {
        return 'POST';
    }

    protected function serialize(): array
    {
        return [
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'capture' => var_export($this->getCapture(), true),
        ] + (
            ($customer = $this->getCustomer()) ? ['customer' => $customer->getId()] : []
        ) + (
            ($source = $this->getSource())
                ? ($source instanceof Card)
                    ? $source->serialize()
                    : ['source' => (string)$source]
                : []
        );
    }

    /**
     * @return Token|Card
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param Token|Card $source
     */
    public function setSource($source): void
    {
        if (!$source instanceof Token && !$source instanceof Card) {
            throw new \InvalidArgumentException('$source must be instance of Token or Card.');
        }

        $this->source = $source;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCapture(): bool
    {
        return $this->capture;
    }

    public function setCapture(bool $capture): void
    {
        $this->capture = $capture;
    }
}
