<?php

namespace WCN\Exceptions;

/**
 * Class UndefinedOrEmptyMethodConstant
 * @package WCN\Exceptions
 *
 * @codeCoverageIgnore
 */
class UndefinedOrEmptyConstant extends \Exception {

	/**
	 * @return string
	 */
	public function get_message(): string {
		return sprintf( 'WP customize nonce: %s is empty or not defined.', $this->message );
	}

}