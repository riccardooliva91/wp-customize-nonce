<?php

namespace WCN\Elements;

use WCN\ElementInterface;

class UrlParameter implements ElementInterface {

	/**
	 * @var string
	 */
	protected $parameter = '';


	/**
	 * UrlParameter constructor.
	 *
	 * @param string $parameter
	 */
	public function __construct( string $parameter ) {
		$this->parameter = $parameter;
	}

	/**
	 * @inheritDoc
	 */
	public function get() {
		// TODO: Implement get() method.
	}

}