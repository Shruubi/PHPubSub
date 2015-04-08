<?php

namespace PHPubSub;

class EventManager 
{
	private static $instance;

	private $container;

	/**
	 * @return EventManager
	 */
	public static function getInstance() {
		if(EventManager::$instance === null) {
			EventManager::$instance = new EventManager();
		}

		return EventManager::$instance;
	}

	private function __construct() {
		$this->container = array();
	}

	/**
	 * @param string $name
	 * @param Callable $closure
	 */
	public function subscribe($name, $closure) {
		$this->container[$name] = $closure;
	}

	public function isSubscribedTo( $name ) {
		return array_key_exists($name, $this->container);
	}

	public function publish( $name, $data = null ) {
		if($data === null) {
			$this->container[$name]();
		} else {
			$this->container[$name]($data);
		}
	}
}