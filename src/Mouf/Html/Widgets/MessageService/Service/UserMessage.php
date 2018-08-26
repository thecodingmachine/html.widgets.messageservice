<?php

namespace Mouf\Html\Widgets\MessageService\Service;

use Mouf\Utils\Value\ValueInterface;
use Mouf\Utils\Value\ValueUtils;

/**
 * The UserMessage class represents a message that is displayed to the user.
 * This is the most simple implementation of the UserMessageInterface interface.
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
class UserMessage implements UserMessageInterface
{
    
    private $message;
    private $type;
    private $category;

    /**
     * Cosntructor initializing all the fields.
     *
     * @param string|ValueInterface $message
     * @param string|ValueInterface $type
     * @param string|ValueInterface $category
     */
    public function __construct($message = null, $type = null, $category = null)
    {
        $this->message = $message;
        $this->type = $type;
        $this->category = $category;
    }
    
    /**
     * Sets the message, as an HTML string to be displayed.
     *
     * @param string|ValueInterface $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }
    
    /**
     * Returns the message, as an HTML string to be displayed.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return ValueUtils::val($this->message);
    }
    
    /**
     * Sets the type of the message.
     * Can be one of UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, or UserMessageInterface::ERROR.
     *
     * @param string|ValueInterface $type
     */
    public function setType($type): void
    {
        $type = ValueUtils::val($type);
        if (!in_array($type, array(UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, UserMessageInterface::ERROR))) {
            throw new \InvalidArgumentException('The type of a message must be one of UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, UserMessageInterface::ERROR');
        }
        
        $this->type = $type;
    }
    
    /**
     * Returns the type of the message.
     * Can be one of UserMessageInterface::SUCCESS, UserMessageInterface::INFO, UserMessageInterface::WARNING, or UserMessageInterface::ERROR.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * Sets the category for this message (or null if this is a global message).
     *
     * @param string|ValueInterface $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }
    
    /**
     * Returns the category for this message (or null if this is a global message).
     *
     * @return string
     */
    public function getCategory(): string
    {
        return ValueUtils::val($this->category);
    }
}
