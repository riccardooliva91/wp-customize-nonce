<?php

namespace WCN\Elements;

use WCN\ElementInterface;

class Cookie implements ElementInterface {

	/**
	 * @var string
	 */
	protected $cookie = '';


	/**
	 * Cookie constructor.
	 *
	 * @param string $cookie
	 */
	public function __construct( string $cookie ) {
		$this->cookie = $cookie;
	}

	/**
	 * @inheritDoc
	 */
	public function get() {
		// TODO: Implement get() method.
	}

}