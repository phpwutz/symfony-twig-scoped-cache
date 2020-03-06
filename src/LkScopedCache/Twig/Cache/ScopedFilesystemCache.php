<?php


namespace LkScopedCache\Twig\Cache;

use Twig\Cache\CacheInterface;
use Twig\Cache\FilesystemCache;

class ScopedFilesystemCache extends FilesystemCache implements CacheInterface
{
    /**
     * @var string
     */
    private $scopeProvider;

    public function __construct(ScopeProvider $scopeProvider)
    {
        $this->scopeProvider = $scopeProvider;

        parent::__construct($this->scopeProvider->getRootDirectory());
    }

    /**
     * {@inheritdoc}
     */
    public function generateKey($name, $className)
    {
        $hash = hash('sha256', $className);

        return $this->scopeProvider->getRootDirectory() . '/' . $this->scopeProvider->getScopedDirectory($name, $className) . '/' . $hash . '.php';
    }
}
