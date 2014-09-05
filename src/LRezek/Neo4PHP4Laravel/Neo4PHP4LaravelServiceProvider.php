<?php namespace LRezek\Neo4PHP4Laravel;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use LRezek\Neo4PHP\Configuration;
use LRezek\Neo4PHP\EntityManager;

use Illuminate\Support\ServiceProvider;

class Neo4PHP4LaravelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    protected $cacheMap = array(
        'array' => '\Doctrine\Common\Cache\ArrayCache',
        'apc' => '\Doctrine\Common\Cache\ApcCache',
        'filesystem' => '\Doctrine\Common\Cache\FilesystemCache',
        'phpFile' => '\Doctrine\Common\Cache\PhpFileCache',
        'winCache' => '\Doctrine\Common\Cache\WinCacheCache',
        'xcache' => '\Doctrine\Common\Cache\XcacheCache',
        'zendData' => '\Doctrine\Common\Cache\ZendDataCache'
    );

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('lrezek/neo4php4laravel');
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Auto.php');
        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/End.php');
        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Index.php');
        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Start.php');
        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Node.php');
        \Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Relation.php');
	\Doctrine\Common\Annotations\AnnotationRegistry::registerFile(app_path() . '/../vendor/lrezek/neo4php/lib/LRezek/Neo4j/Annotation/Property.php');

	$default = $this->app['config']->get('database.default');
        $settings = $this->app['config']->get('database.connections');

        $config = (!empty($default) && $default == 'neo4j') ? $settings[$default] : $settings;

        if (empty($config['annotation_reader']) && !empty($config['meta_data_cache'])) {
            $metaCache = new $this->cacheMap[$config['meta_data_cache']];
            $metaCache->setNamespace((empty($config['cache_prefix'])) ? 'neo4j' : $config['cache_prefix']);

            $config['annotation_reader'] = new CachedReader(
                new AnnotationReader, $metaCache, false
            );
        }

        $this->app->singleton(
            'entityManager',
            function () use ($config) {
                return new EntityManager(new Configuration($config));
            }
        );

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
