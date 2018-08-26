<?php

namespace Mouf\Html\Widgets\MessageService\Service\Actions;

use Mouf\Utils\Action\ActionInterface;
use Mouf\Html\Widgets\MessageService\Service\MessageProviderInterface;
use Mouf\Html\Widgets\MessageService\Service\UserMessageInterface;
use Mouf\Html\Widgets\MessageService\Service\SessionMessageService;

/**
 * The action is used to add a message to a message service (using the action system)
 *
 * A message has:
 * - an HTML text
 * - a type (SUCCESS, INFO, WARNING, ERROR)
 * - a category
 *
 * If the category is null, the user message is "global". This means the message should be displayed at the top of
 * the page. If the category is set, the message applies to a part of the page (usually to a field that was not
 * correctly completed).
 *
 * @author David Negrier
 */
class DisplayMessageAction implements ActionInterface
{
    
    private $message;
    private $messageService;

    /**
     *
     * @param UserMessageInterface $message The message to be displayed
     * @param SessionMessageService $messageService The message service
     */
    public function __construct(UserMessageInterface $message, SessionMessageService $messageService)
    {
        $this->message = $message;
        $this->messageService = $messageService;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Mouf\Utils\Action\ActionInterface::run()
     */
    public function run()
    {
        $this->messageService->setMessage($this->message->getMessage(), $this->message->getType(), $this->message->getCategory());
    }
}
