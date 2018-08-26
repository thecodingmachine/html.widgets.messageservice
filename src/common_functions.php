<?php
use Mouf\MoufManager;

use Mouf\Html\Widgets\MessageService\Service\UserMessageInterface;

/**
 * Sets a message to be displayed to a user.
 *
 * @param string $html The message to be displayed, as a HTML string.
 * @param string $type The type of the message. Can be one of UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, UserMessageInterface::ERROR.
 * @param string|null $category The category of the message to set. A category is a string. If "null", the global category is used (this means the message will be displayed at the top of the screen).
 */
if (!function_exists("set_user_message")) {
    function set_user_message(string $html, string $type = UserMessageInterface::ERROR, string $category = null): void
    {
        throw new \RuntimeException('set_user_message function not migrated yet');
        //$instance = MoufManager::getMoufManager()->getInstance("userMessageService");
        /* @var $instance SessionMessageService */
        //$instance->setMessage($html, $type, $category);
    }
}
