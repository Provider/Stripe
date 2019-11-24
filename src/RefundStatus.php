<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static self SUCCEEDED
 * @method static self PENDING
 * @method static self FAILED
 * @method static self CANCELLED
 */
final class RefundStatus extends AbstractEnumeration
{
    public const SUCCEEDED = 'SUCCEEDED';
    public const PENDING = 'PENDING';
    public const FAILED = 'FAILED';
    public const CANCELLED = 'CANCELLED';
}
