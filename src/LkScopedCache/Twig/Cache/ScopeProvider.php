<?php

namespace LkScopedCache\Twig\Cache;

interface ScopeProvider
{

    /**
     * @param string $name
     * @param string $className
     * @return string
     */
    public function getScopedDirectory(string $name, string $className): string;

    /**
     * @return string
     */
    public function getRootDirectory(): string;

}
