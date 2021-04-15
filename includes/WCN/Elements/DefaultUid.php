<?php

namespace WCN\Elements;

use WCN\ElementInterface;

/**
 * Class DefaultUid
 * @package WCN\Elements
 */
class DefaultUid implements ElementInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		$result = 0;
		$user   = wp_get_current_user();
		if ( ! empty( $user ) && ! empty( $user->ID ) ) {
			$result = $user->ID;
		}

		return $result;
	}

}