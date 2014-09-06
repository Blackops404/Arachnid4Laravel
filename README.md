About
=====

This is a service provider for Laravel 4.1 that uses [Lukas Rezek's PHP OGM](https://github.com/lrezek/Neo4PHP). It is based off of [Levi Stanley's Neo4jPhpOgm](https://github.com/niterain/Neo4jPhpOgm), but updated to work with Laravel 4.1.

Installation
=============

Add `lrezek/neo4php4laravel` as a requirement to `composer.json`:

```JavaScript
{
    "require": {
       "lrezek/neo4php4laravel": "dev-master"
    }
}
```

You may need to add the package dependencies as well, depending on your `minimum-stability` setting:

```JavaScript
{
    "require": {
       "everyman/neo4jphp":"dev-master",
       "lrezek/neo4php":"dev-master"
    }
}
```

Update your packages with `composer update` or install with `composer install`.

Once Composer has updated your packages, you'll need to tell Lavarel about the service provider. Add the following to the `providers` in `app/config/app.php`: 

```PHP
'LRezek\Neo4PHP4Laravel\Providers\Neo4PHP4LaravelServiceProvider',
```

And the facade to the `facades`:

```PHP
'OGM' => 'LRezek\Neo4PHP4Laravel\Facades\Neo4PHP4LaravelFacade',
```

Note: You can change the name of the facade (`OGM`) to whatever you like.

Database Configuration
===========

The Neo4J database configuration is autoloaded from `app/config/database.php`. To add a Neo4J connection, simply add the following to the `connections` parameter:

```PHP
'neo4j' => array(
            'transport' => 'curl',
            'host' => 'localhost',
            'port' => '7474',
            'debug' => true,
            'proxy_dir' => '/tmp',
            'cache_prefix' => 'neo4j',
            'meta_data_cache' => 'array',
            'annotation_reader' => null,
            'username' => null,
            'password' => null,
            'pathfinder_algorithm' => null,
            'pathfinder_maxdepth' => null
        )
```

And set the default connection as follows:

```PHP
'default' => 'neo4j',
```

Usage
============================

Once this set-up is complete, you can use entities and do queries as shown in [Neo4PHP](https://github.com/lrezek/Neo4PHP). To call functions in the entity manager, simply use the facade you defined above. For example:

```PHP
OGM::persist()
```