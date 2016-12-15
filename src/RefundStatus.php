<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * @method static SUCCEEDED()
 * @method static PENDING()
 * @method static FAILED()
 * @method static CANCELLED()
 */
final class RefundStatus extends AbstractEnumeration
{
    const SUCCEEDED = 'SUCCEEDED';
    const PENDING = 'PENDING';
    const FAILED = 'FAILED';
    const CANCELLED = 'CANCELLED';
}
