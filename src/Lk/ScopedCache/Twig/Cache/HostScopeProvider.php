<?php

namespace Lk\ScopedCache\Twig\Cache;

use Symfony\Component\HttpFoundation\RequestStack;

class HostScopeProvider implements ScopeProvider
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string
     */
    private $rootDir;

    public function __construct(string $rootDir, RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->rootDir = $rootDir;
    }

    /**
     * @inheritDoc
     */
    public function getScopedDirectory(string $name, string $className): string
    {
        return $this->requestStack->getCurrentRequest()->getHost();
    }

    /**
     * @inheritDoc
     */
    public function getRootDirectory(): string
    {
        return $this->rootDir;
    }
}