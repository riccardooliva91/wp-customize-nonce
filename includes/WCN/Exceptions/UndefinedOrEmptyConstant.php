<?php

namespace WCN\Exceptions;

/**
 * Class UndefinedOrEmptyMethodConstant
 * @package WCN\Exceptions
 */
class UndefinedOrEmptyConstant extends \Exception {

	/**
	 * @return mixed
	 */
	public function get_message() {
		return sprintf( 'WP customize nonce: %s is empty or not defined.', $this->message );
	}

}