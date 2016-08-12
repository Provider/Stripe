<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider;

use ScriptFUSION\Porter\Net\Http\HttpOptions;

interface StripeResource
{
    public function setOptions(HttpOptions $options);
}
