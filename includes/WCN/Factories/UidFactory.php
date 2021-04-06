<?php

namespace WCN\Factories;

use WCN\FactoryInterface;

/**
 * Class UidFactory
 * @package WCN\Factories
 */
class UidFactory implements FactoryInterface {

	/**
	 * @inheritDoc
	 */
	public function get() {
		if ( ! defined( 'WCN_UID_METHOD' ) ) {
			throw new \Exception( 'WP customize nonce: WCN_UID_METHOD is not defined.' );
		}

		switch ( WCN_UID_METHOD ) {
			case 'user_id':// Default WP method
				return new \WCN\Uid\UserId();

			case 'ip':
				return new \WCN\Uid\Ip();

			case 'none':
				return new \WCN\Uid\EmptyUid();

			case 'cookie':
				if ( ! defined( 'WCN_UID_COOKIE_NAME' ) ) {
					throw new \Exception( 'WP customize nonce: WCN_UID_COOKIE_NAME must be defined if you wish to generate the UID from a cookie.' );
				}

				return new \WCN\Uid\Cookie( WCN_UID_COOKIE_NAME );

			default:
				throw new \Exception( sprintf( 'WP customize nonce: %s is not a valid value for WCN_UID_METHOD.', WCN_UID_METHOD ) );
		}
	}

}