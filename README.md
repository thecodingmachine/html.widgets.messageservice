# User Message Service

This service allows to implement user oriented messaging. It relies on a simple function that will add a message with a given level, and an HTML block that will render user's messages when the page is loaded.

![Example](doc/img/example.png)

## Using the Service

When the package is installed, a block is added to the template's content. When rendered, this block will dump the messages that were stored into the session.

Add a message :

```php
$messageService->setMessage("User <b>foo bar</b> has been successfully cerated", UserMessageInterface::SUCCESS);
```

The `UserMessageInterface` defines 4 types of message :

 * SUCCESS
 * INFO
 * WARNING
 * ERROR
 
By default, the message will be displayed in the header block. But you are free to insert this block anywhere.

More Information can be found here :

 * [Using the message service](doc/index.md)
 * [Advanced usage](doc/advanced.md)
