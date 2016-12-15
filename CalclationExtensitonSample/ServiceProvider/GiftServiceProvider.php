<?php

namespace Plugin\Gift\ServiceProvider;


class GiftServiceProvider implements \Silex\ServiceProviderInterface
{
    public function register(\Silex\Application $app)
    {
        // contextにGiftWrapping用のStrategyを追加
        $app['eccube.calculate.context'] = $app->share(
            $app->extend(
                'eccube.calculate.context',
                function ($context) {
                    $context->addStrategy(new \Plugin\Gift\Calc\GiftStrategy());

                    return $context;
                }
            )
        );
    }

    public function boot(\Silex\Application $app)
    {
        // TODO: Implement boot() method.
    }
}