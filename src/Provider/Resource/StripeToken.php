<?php
namespace ScriptFUSION\Porter\Provider\Stripe\Provider\Resource;

use ScriptFUSION\Porter\Connector\Connector;
use ScriptFUSION\Porter\Net\Http\HttpOptions;
use ScriptFUSION\Porter\Provider\Resource\AbstractResource;
use ScriptFUSION\Porter\Provider\Stripe\Card;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeProvider;
use ScriptFUSION\Porter\Provider\Stripe\Provider\StripeResource;

class StripeToken extends AbstractResource implements StripeResource
{
    const RESOURCE = 'tokens';

    private $card;

    /** @var HttpOptions */
    private $options;

    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    public function getProviderClassName()
    {
        return StripeProvider::class;
    }

    public function fetch(Connector $connector)
    {
        $data = $connector->fetch(
            self::RESOURCE,
            $this->options
                ->setMethod('POST')
                ->setContent(http_build_query($this->card->serialize()))
        );

        yield json_decode($data, true);
    }

    public function setOptions(HttpOptions $options)
    {
        $this->options = $options;
    }
}
