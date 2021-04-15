<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class UrlParameter
 * @package WCN\Elements
 */
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
		return filter_input( INPUT_GET, $this->parameter );
	}

}