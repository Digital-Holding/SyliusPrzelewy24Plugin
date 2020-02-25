<h1 align="center">
    <a href="http://bitbag.shop" target="_blank">
        <img src="doc/logo.jpeg" width="55%" />
    </a>
    <br />
    <a href="https://packagist.org/packages/bitbag/przelewy24-plugin" title="License" target="_blank">
        <img src="https://img.shields.io/packagist/l/bitbag/przelewy24-plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/bitbag/przelewy24-plugin" title="Version" target="_blank">
        <img src="https://img.shields.io/packagist/v/bitbag/przelewy24-plugin.svg" />
    </a>
    <a href="http://travis-ci.org/BitBagCommerce/SyliusPrzelewy24Plugin" title="Build status" target="_blank">
            <img src="https://img.shields.io/travis/BitBagCommerce/SyliusPrzelewy24Plugin/master.svg" />
        </a>
    <a href="https://scrutinizer-ci.com/g/BitBagCommerce/SyliusPrzelewy24Plugin/" title="Scrutinizer" target="_blank">
        <img src="https://img.shields.io/scrutinizer/g/BitBagCommerce/SyliusPrzelewy24Plugin.svg" />
    </a>
    <a href="https://packagist.org/packages/bitbag/przelewy24-plugin" title="Total Downloads" target="_blank">
        <img src="https://poser.pugx.org/bitbag/przelewy24-plugin/downloads" />
    </a>
    <p>
        <img src="https://sylius.com/assets/badge-approved-by-sylius.png" width="85">
    </p>
</h1>

## Overview

This plugin allows you to integrate Przelewy24 payment with Sylius platform app. It includes all Sylius and Przelewy24 payment features.

## Support

You can order our support on [this page](https://bitbag.shop/products/sylius-mailchimp).

We work on amazing eCommerce projects on top of Sylius and other great Symfony based solutions, like eZ Platform, Akeneo or Pimcore.
Need some help or additional resources for a project? Write us an email on mikolaj.krol@bitbag.pl or visit
[our website](https://bitbag.shop/)! :rocket:

## Demo

We created a demo app with some useful use-cases of the plugin! Visit [demo.bitbag.shop](https://demo.bitbag.shop) to take a look at it.

## Installation

```bash
$ composer require bitbag/przelewy24-plugin
```

Add plugin dependencies to your `config/bundles.php` file:
```php
return [
    ...

    BitBag\SyliusPrzelewy24Plugin\BitBagSyliusPrzelewy24Plugin::class => ['all' => true],
];
```

## Customization

### Available services you can [decorate](https://symfony.com/doc/current/service_container/service_decoration.html) and forms you can [extend](http://symfony.com/doc/current/form/create_form_type_extension.html)

Run the below command to see what Symfony services are shared with this plugin:
```bash
$ bin/console debug:container bitbag_sylius_przelewy24_plugin
```

## Testing
```bash
$ composer install
$ cd tests/Application
$ yarn install
$ yarn run gulp
$ bin/console assets:install -e test
$ bin/console doctrine:database:create -e test
$ bin/console doctrine:schema:create -e test
$ bin/console server:run 127.0.0.1:8080 -e test
$ open http://localhost:8080
$ bin/behat
$ bin/phpspec run
```

## Support for local testing

Testing in local environments is problematic as often you do not want to expose your development instance to the public, outside world.
This is a specially modified version which allows easier testing in local environments by using a proxy notifier.

How this works?

* Create the `config/packages/bit_bag_sylius_przelewy24.yaml` config file with contents:
```yaml
bit_bag_sylius_przelewy24:
  fake_notify_url: http://example.com/some_fake_notifier_{token}
```

* Expose a public proxy which will capture the incoming POST request from **Przelewy24**.

* Resend it to the notify **Payum Notify Url**. By default in local Symfony:

`http://localhost:8000/payment/notify/{token}`

### An example with POST Resender to Telegram

* Download, place under a public webserver, and install (using `composer install`) the lib:

https://github.com/ideaconnect/php-http-request-to-telegram

Make sure that its `/public` folder is exposed and catches all the traffic using `index.php` file.

* Create yourself a telegram bot and telegram channel (takes up to 4 minutes), learn how to do this here: https://github.com/ideaconnect/php-telegram-sender

* Set up the project file - for example to look as follows:
```json
[
    {
        "route": "/przelewy24",
        "bot_id": "1000000000",
        "bot_secret": "AAAAAAAAAAAAAAAAAAAAA",
        "channel_id": "1101010101"
    }
]
```

Replace `bot_id`, `bot_secret`, `channel_id` with respective values.

Now the **HTTP Post Resender** will resend any traffic sent to an endpoint starting with `/przelewy24` to Telegram IM.

Sample message:
```
POST /przelewy24?token=_u8-Y2w2cAXgHfy-bmnekenAMQ_V-lmONvm2mxL7iU0
p24_session_id=5e49aa1854a95&p24_amount=13956&p24_order_id=304756184&p24_pos_id=104770&p24_merchant_id=104770&p24_method=112&p24_statement=p24-A75-A61-E84&p24_currency=PLN&p24_sign=26f34e1bfea307ef545feadaaf228db6
```

Now resend this, for example using **Postman** application to your local Sylius instance - by default notify URL is:
`http://localhost:8000/payment/notify/{token}`

So in this case, resend this post to:
`http://localhost:8000/payment/notify/_u8-Y2w2cAXgHfy-bmnekenAMQ_V-lmONvm2mxL7iU0`

## Additional options

`allow_retry` - allows multiple attempts over same payment objects, until status `completed` is reached.
Defaults to `true`.

## Contribution

Learn more about our contribution workflow on http://docs.sylius.org/en/latest/contributing/.
