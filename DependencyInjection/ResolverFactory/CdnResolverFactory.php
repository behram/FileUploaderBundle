<?php


/**
 * @namespace
 */
namespace Jb\Bundle\FileUploaderBundle\DependencyInjection\ResolverFactory;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * CdnResolverFactory
 *
 * @author jobou
 */
class CdnResolverFactory implements ResolverFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return 'cdn';
    }

    /**
     * {@inheritdoc}
     */
    public function addConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('url')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $container
            ->setDefinition($id, new DefinitionDecorator('jb_fileuploader.resolver.cdn.prototype'))
            ->setScope('request')
            ->addArgument($config['url'])
        ;
    }
}