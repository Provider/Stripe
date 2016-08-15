<?php
namespace ScriptFUSION\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Type\StringType;

final class Customer
{
    private $id;

    /**
     * Customer constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    public static function isValidIdentifier($id)
    {
        return StringType::startsWith($id, 'cus_');
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = "$id";
    }
}
