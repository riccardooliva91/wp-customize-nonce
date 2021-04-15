<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class EmptyElement
 * @package WCN\Elements
 *
 * @codeCoverageIgnore
 */
class EmptyElement implements ElementInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		return null;
	}

}