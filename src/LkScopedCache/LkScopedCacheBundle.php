<?php


namespace LkScopedCache;

use Lk\ScopedCache\DependencyInjection\Compiler\TwigCachePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LkScopedCacheBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigCachePass());
    }
}