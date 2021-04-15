<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class EmptyElement
 * @package WCN\Elements
 */
class EmptyElement implements ElementInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		return null;
	}

}