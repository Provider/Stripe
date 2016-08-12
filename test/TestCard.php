<?php
namespace ScriptFUSIONTest\Porter\Provider\Stripe;

use ScriptFUSION\Porter\Provider\Stripe\Card;

class TestCard extends Card
{
    public function __construct()
    {
        parent::__construct('4242424242424242', 12, date('Y') + 1, '123');
    }
}
