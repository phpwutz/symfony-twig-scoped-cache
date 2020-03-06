<?php

namespace Lk\ScopedCache\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TwigCachePass implements \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has('twig')) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds('lk_scopedcache');

        $twig = $container->findDefinition('twig');
        foreach ($taggedServices as $id => $tags) {
            $twig->addMethodCall(
                'setCache', [new Reference($id)]
            );
        }
    }
}
