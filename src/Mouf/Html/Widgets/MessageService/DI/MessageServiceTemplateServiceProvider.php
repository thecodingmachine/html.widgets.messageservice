<?php

namespace Mouf\Html\Widgets\MessageService\DI;

use Mouf\Html\Renderer\AbstractPackageRendererServiceProvider;

class MessageServiceTemplateServiceProvider extends AbstractPackageRendererServiceProvider
{
    public static function getTemplateDirectory(): string
    {
        // Here, return the path to the templates directory of your package.
        return __DIR__.'/src/templates';
    }
}
