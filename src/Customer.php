<?php
declare(strict_types=1);

namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Type\StringType;

final class Customer
{
    private $id;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    public static function isValidIdentifier($id): bool
    {
        return StringType::startsWith($id, 'cus_');
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function setId(string $id): void
    {
        if (!self::isValidIdentifier($id)) {
            throw new InvalidIdentifierException("Invalid customer identifier: \"$id\".");
        }

        $this->id = $id;
    }
}
