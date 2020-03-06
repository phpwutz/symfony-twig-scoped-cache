# Scoped Twig cache

Scoped twig template cache. Useful if you run many domains/clients with separate templates but don't want to clear all template caches just to update one domain/client.

The basic idea is that the template cache is generated on a scope basis.

The default Scope is "Hostname", but you can roll your own, too

In your bundles.php, add:
```php
<?php
return [
    // ...,
    \LkScopedCache\LkScopedCacheBundle::class => ['all' => true],
];   
```


## Configuration

This is only a sample configuration using the packaged "HostScopeProvider". It will scope your templates based on the Hostname.

In your services.yml, configure a scope provider:

```
    hostscope_provider:
        class: LkScopedCache\Twig\Cache\HostScopeProvider
        arguments:
            - "%kernel.cache_dir%/twig"
            - "@request_stack"
```

Configure the Scoped Filesystem Cache using the above provider:

```
    my_app.twig.cache.website_aware:
        class: Lk\ScopedCache\Twig\Cache\ScopedFilesystemCache
        arguments:
            - '@hostscope_provider'
        tags: ['lk_scopedcache']
```

It is important to give the tag "lk_scopedcache" to the cache class, because this will trigger the default twig cache to be replaced with the scoped cache.


### Customization

You can also implement your own ScopeProvider by implementing the `LkScopedCache\Twig\Cache\ScopeProvider` interface.
