<?php

namespace WCN\Exceptions;

use Throwable;

/**
 * Class InvalidConstantValue
 * @package WCN\Exceptions
 *
 * @codeCoverageIgnore
 */
class InvalidConstantValue extends \Exception {

	/**
	 * @var string
	 */
	protected $const = '';

	/**
	 * @var string
	 */
	protected $value = '';


	/**
	 * InvalidConstantValue constructor.
	 *
	 * @param string $const
	 * @param string $value
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct( $const = '', $value = '', $code = 0, Throwable $previous = null ) {
		$this->const = $const;
		$this->value = $value;
		parent::__construct( $const . $value, $code, $previous );
	}

	/**
	 * @return mixed
	 */
	public function get_message() {
		return sprintf( 'WP customize nonce: %s is not a valid value for %s.', $this->value, $this->const );
	}

}