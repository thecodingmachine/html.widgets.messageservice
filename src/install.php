<?php
use Mouf\Html\Utils\WebLibraryManager\WebLibraryInstaller;

require_once __DIR__."/../../../autoload.php";

use Mouf\MoufManager;

use Mouf\Actions\InstallUtils;

// Let's init Mouf
InstallUtils::init(InstallUtils::$INIT_APP);

// Let's create the instance
$moufManager = MoufManager::getMoufManager();
if (!$moufManager->instanceExists("userMessageService")) {
	$userMessageService = $moufManager->createInstance("Mouf\\Html\\Widgets\\MessageService\\Service\\SessionMessageService");
	$userMessageService->setName("userMessageService");
}

if (!$moufManager->instanceExists("messageWidget")) {
	$messageWidget = $moufManager->createInstance("Mouf\\Html\\Widgets\\MessageService\\Widget\MessageWidget");
	$messageWidget->setName("messageWidget");
	$messageWidget->getProperty("messageProvider")->setValue($userMessageService);
}

// Let's add the widget to the main block if available.
if ($moufManager->instanceExists("block.content")) {
	$contentBlock = $moufManager->getInstanceDescriptor("block.content");
	$arr = $contentBlock->getProperty("children")->getValue();
	$arr[] = $messageWidget;
	$contentBlock->getProperty("children")->setValue($arr);
}

//Create a weblibrary for loading message services css file, and add it into the defaultWebLibrary Manager
WebLibraryInstaller::installLibrary("messageServiceLibrary",
	array(),
	array('vendor/mouf/html.widgets.messageservice/messages.css'),
	array(),
	true
);

// Let's rewrite the MoufComponents.php file to save the component
$moufManager->rewriteMouf();

// Finally, let's continue the install
InstallUtils::continueInstall();
?>