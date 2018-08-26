<?php


namespace Mouf\Html\Widgets\MessageService\DI;

use Mouf\Html\HtmlElement\HtmlBlock;
use Mouf\Html\Utils\WebLibraryManager\WebLibrary;
use Mouf\Html\Widgets\MessageService\Service\SessionMessageService;
use Mouf\Html\Widgets\MessageService\Widget\MessageWidget;
use Mouf\Utils\Session\SessionManager\SessionManagerInterface;
use Psr\Container\ContainerInterface;
use TheCodingMachine\Funky\Annotations\Extension;
use TheCodingMachine\Funky\Annotations\Factory;
use TheCodingMachine\Funky\Annotations\Tag;
use TheCodingMachine\Funky\ServiceProvider;
use Mouf\Html\Widgets\MessageService\Service\MessageProviderInterface;

class MessageServiceServiceProvider extends ServiceProvider
{
    /**
     * @Factory(aliases={MessageServiceInterface::class})
     */
    public function createSessionMessageService(?SessionManagerInterface $sessionManager): MessageProviderInterface
    {
        return new SessionMessageService($sessionManager);
    }

    /**
     * @Factory()
     */
    public static function createMessageWidget(MessageProviderInterface $messageProvider): MessageWidget
    {
        return new MessageWidget($messageProvider);
    }

    /**
     * @Extension(name="block.content")
     */
    public static function extendContent(?HtmlBlock $content, MessageWidget $messageWidget): HtmlBlock
    {
        if ($content !== null) {
            $content->addHtmlElement($messageWidget);
        }
        return $content;
    }

    /**
     * @Factory(name="messageServiceWebLibrary", tags={@Tag(name="webLibraries")})
     */
    public static function createWebLibrary(ContainerInterface $container): WebLibrary
    {
        return new WebLibrary(
            [],
            ['vendor/mouf/html.widgets.messageservice/messages.css'],
            $container->get('root_url')
        );
    }
}
