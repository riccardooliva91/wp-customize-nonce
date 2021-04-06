<?php

namespace WCN\Uid;

use WCN\UidInterface;

/**
 * Class Cookie
 * @package WCN\Uid
 */
class Cookie implements UidInterface {

	/**
	 * @var string
	 */
	protected $cookie = '';


	/**
	 * Cookie constructor.
	 *
	 * @param string $cookieName
	 */
	public function __construct( string $cookieName ) {
		$this->cookie = $cookieName;
	}

	/**
	 * @inheritDoc
	 */
	public function get() {
		return filter_input( INPUT_COOKIE, $this->cookie );
	}

}