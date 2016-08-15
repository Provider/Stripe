<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Type\StringType;

final class Charge
{
    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 'ch_');
    }
}
