<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Token
{
    private $id;

    public function __construct($id)
    {
        $this->setId($id);
    }

    public function __toString()
    {
        return "$this->id";
    }

    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 'tok_');
    }

    private function setId($id)
    {
        if (!self::isValidIdentifier($id)) {
            throw new InvalidIdentifierException("Invalid token identifier: \"$id\".");
        }

        $this->id = "$id";
    }
}
