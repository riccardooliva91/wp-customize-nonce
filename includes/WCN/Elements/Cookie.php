<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class Cookie
 * @package WCN\Elements
 */
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
		return filter_input( INPUT_COOKIE, $this->cookie );
	}

}