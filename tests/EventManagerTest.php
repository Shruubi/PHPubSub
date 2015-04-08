<?php

use PHPubSub\EventManager;

class EventManagerTest extends PHPUnit_Framework_TestCase
{

    public function testEventManagerSingletonHasInstance()
    {
        $this->assertNotNull(EventManager::getInstance());
	    $this->assertInstanceOf('PHPubSub\\EventManager', EventManager::getInstance());
    }

	public function testCanRegisterSubscriberClosure()
	{
		EventManager::getInstance()->subscribe("test", function() {
			echo "hello world";
		});

		$this->assertTrue(EventManager::getInstance()->isSubscribedTo("test"));
	}

	public function testCanPublish() {
		EventManager::getInstance()->subscribe("test", function() {
			$this->assertTrue(true);
		});

		EventManager::getInstance()->publish("test");
	}
}