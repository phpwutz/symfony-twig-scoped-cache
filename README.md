# Scoped Twig cache

Scoped twig template cache. Useful if you run many domains/clients with separate templates but don't want to clear all template caches just to update one domain/client.

The basic idea is that the template cache is generated on a scope basis.

The default Scope is "Hostname", but you can roll your own, too

In your services.yml, configure a scope provider:

```
    my_app.twig.cache.scope_provider:
        class: App\Twig\Cache\PrincipalScopeProvider
        arguments:
            - '%kernel.cache_dir%/twig'
```

Configure the Scoped Filesystem Cache using the above provider:

```
    my_app.twig.cache.website_aware:
        class: Lk\ScopedCache\Twig\Cache\ScopedFilesystemCache
        arguments:
            - '@my_app.twig.cache.scope_provider'
        tags: ['lk_scopedcache']
```


