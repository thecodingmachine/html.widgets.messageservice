<?php
namespace Mouf\Html\Widgets\MessageService\Widget;

use Mouf\Html\Widgets\MessageService\Service\MessageProviderInterface;
use Mouf\Html\HtmlElement\HtmlElementInterface;
use Mouf\Html\Widgets\MessageService\Service\UserMessageInterface;

/**
 * The MessageWidget is in charge of displaying HTML messages.
 * Those messages are registered using an object implementing the MessageProviderInterface object.
 * Usually, this is a SessionMessageService object, and the developper accesses that object using the simple "set_user_message" function.
 * 
 * @author David Negrier
 * @Component
 */
class MessageWidget implements HtmlElementInterface {
	
	/**
	 * The object that will return the messages to be displayed.
	 * 
	 * @var MessageProviderInterface
	 */
	private $messageProvider;


    public function __construct(MessageProviderInterface $messageProvider)
    {
        $this->messageProvider = $messageProvider;
	}


	/**
	 * Renders the messages in HTML.
	 * The Html is echoed directly into the output.
	 */
	public function toHtml() {
		
		// An array of messages where the message is the KEY and the value is array("type"=>$type, "nbOccurences"=>$nbOcc).
		// Used to avoid displaying duplicate messages.
		$invertedMessages = array();
		
		$toDisplayMessages = array();
		
		$messages = $this->messageProvider->getMessages();
		foreach ($messages as $message) {
			/* @var $message UserMessageInterface */
			$html = $message->getMessage();
			$type = $message->getType();
			if (isset($invertedMessages[$html]) && $invertedMessages[$html]["type"] == $type) {
				$invertedMessages[$html]["nbOccurences"] += 1;
			} else {
				$invertedMessages[$html] = array("type"=>$type, "nbOccurences"=>1);
				$toDisplayMessages[] = $message;
			}
		}
 
		foreach ($toDisplayMessages as $message) {
			/* @var $message UserMessageInterface */
			$renderedMessage = new RenderedMessage($message, $invertedMessages[$message->getMessage()]['nbOccurences']);
			$renderedMessage->toHtml();
		}
	}
}