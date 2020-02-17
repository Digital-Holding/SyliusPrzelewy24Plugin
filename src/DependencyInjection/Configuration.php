<?php

declare(strict_types=1);

namespace BitBag\SyliusPrzelewy24Plugin\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('bit_bag_sylius_przelewy24');
        if (\method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('bit_bag_sylius_przelewy24');
        }

        $rootNode->children()
            ->scalarNode('fake_notify_url')
            ->end()
        ->end()
        ;

        return $treeBuilder;
    }
}
