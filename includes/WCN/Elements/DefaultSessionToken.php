<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class DefaultSessionToken
 * @package WCN\Elements
 *
 * @codeCoverageIgnore
 */
class DefaultSessionToken implements ElementInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		return wp_get_session_token();
	}

}