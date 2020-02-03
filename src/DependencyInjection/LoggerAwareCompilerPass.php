<?php

namespace App\DependencyInjection;

use App\Logger\LoggerAwareInterface;
use ReflectionClass;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class LoggerAwareCompilerPass implements CompilerPassInterface
{
    public function process(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $definitions = $container->getDefinitions();

        foreach ($definitions as $definition) {
            $reflexion = new ReflectionClass($definition->getClass());
            $interfaces = $reflexion->getInterfaceNames();

            if (in_array(LoggerAwareInterface::class, $interfaces)) {
                $definition->addMethodCall('setLogger', [new Reference('logger')]);
            }
        }
    }
}
