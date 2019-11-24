<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

/**
 * The exception that is thrown when a 402 Payment Required error occurs in the Stripe subsystem.
 */
class StripePaymentException extends \RuntimeException
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $param;

    /**
     * @var string
     */
    private $stripeCode;

    public function __construct($message, $type, $stripeCode, $param = null, \Exception $previous = null)
    {
        parent::__construct($message, 402, $previous);

        $this->type = $type;
        $this->param = $param;
        $this->stripeCode = $stripeCode;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getParam(): ?string
    {
        return $this->param;
    }

    /**
     * @return string
     */
    public function getStripeCode(): string
    {
        return $this->stripeCode;
    }
}
