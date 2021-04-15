<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class Value
 * @package WCN\Elements
 */
class Value implements ElementInterface {

	/**
	 * @var mixed
	 */
	protected $value;


	/**
	 * Value constructor.
	 *
	 * @param mixed $value
	 */
	public function __construct( $value ) {
		$this->value = $value;
	}


	/**
	 * @inheritDoc
	 */
	public function get() {
		return $this->value;
	}

}