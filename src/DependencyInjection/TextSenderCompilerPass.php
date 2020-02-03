<?php

namespace App\DependencyInjection;

use App\Texter\MultipleTexter;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TextSenderCompilerPass implements CompilerPassInterface
{
    public function process(\Symfony\Component\DependencyInjection\ContainerBuilder $container)
    {
        $multipleTexterDefinition = $container->getDefinition(MultipleTexter::class);

        $textSendersIds = $container->findTaggedServiceIds('text_sender');

        foreach ($textSendersIds as $id => $args) {
            foreach ($args as $arg) {
                $multipleTexterDefinition->addMethodCall('addTexter', [new Reference($id), $arg['message']]);
            }
        }
    }
}
