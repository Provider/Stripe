Stripe
======

[![Latest version][Version image]][Releases]
[![Total downloads][Downloads image]][Downloads]
[![Build status][Build image]][Build]
[![Test coverage][Coverage image]][Coverage]
[![Code style][Style image]][Style]

A [Porter][Porter] provider for [Stripe][Stripe], an online payment processor. Unlike the [official library][Stripe library], this implementation supports multiple instances and testing with mocks because it [does not rely on global state][Stripe static issue].

This implementation currently is incomplete, however the API design currently serves as one of the better reference implementations for those wishing to write similar providers for other services. [Pull requests][PRs] for missing Stripe API features are more than welcome.

Usage
-----

Add the dependency to your Composer files `require` section.

```
"provider/stripe": "^3"
```

Once the provider is registered simply import any of its resources to invoke Stripe functionality. For example, to create a charge we could import `CreateCharge`.

```php
$card = new Card('4242424242424242', 12, 2020, '123');
$response = $porter->importOne(new ImportSpecification(new CreateCharge($card)));
```

Requirements
------------

- [PHP 5.5](http://php.net)
- [Composer](http://getcomposer.org)
- [Porter][Porter]


  [Porter]: https://github.com/ScriptFUSION/Porter
  [Releases]: https://github.com/Provider/Stripe/releases
  [Version image]: https://poser.pugx.org/provider/stripe/version "Latest version"
  [Downloads]: https://packagist.org/packages/provider/stripe
  [Downloads image]: https://poser.pugx.org/provider/stripe/downloads "Total downloads"
  [Build]: http://travis-ci.org/Provider/Stripe
  [Build image]: https://travis-ci.org/Provider/Stripe.svg?branch=master "Build status"
  [Coverage]: https://coveralls.io/github/Provider/Stripe
  [Coverage image]: https://coveralls.io/repos/Provider/Stripe/badge.svg "Test coverage"
  [Style]: https://styleci.io/repos/65310636
  [Style image]: https://styleci.io/repos/65310636/shield?style=flat "Code style"

  [PRs]: https://github.com/Provider/Stripe/pulls
  [Stripe]: https://stripe.com
  [Stripe library]: https://github.com/stripe/stripe-php
  [Stripe static issue]: https://github.com/stripe/stripe-php/issues/124
