<?php

namespace WCN\Tests\WCN;

use WCN\Tests\WCN_TestCase;

/**
 * Class WcnTest
 * @package WCN\Tests\WCN
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class WcnTest extends WCN_TestCase {

	public function testNonce() {
		define( 'WCN_VALIDATE_OLD_NONCES', false );
		define( 'WCN_UID_METHOD', 'fixed' );
		define( 'WCN_UID', 'value' );
		define( 'WCN_TOKEN_METHOD', 'fixed' );
		define( 'WCN_TOKEN', 'value' );
		define( 'WCN_NONCE_OFFSET', 0 );
		define( 'WCN_NONCE_LENGTH', 10 );

		\Brain\Monkey\Functions\expect( 'wp_nonce_tick' )->once()->andReturn( 1 );
		\Brain\Monkey\Functions\expect( 'wp_hash' )->twice()->andReturn( 'hash' );

		$test  = new \WCN\Wcn( 'action' );
		$nonce = $test->generate_nonce();
		$this->assertEquals( 1, $test->validate( $nonce ) );
	}

	public function testOlderNonce() {
		define( 'WCN_VALIDATE_OLD_NONCES', true );
		define( 'WCN_UID_METHOD', 'fixed' );
		define( 'WCN_UID', 'value' );
		define( 'WCN_TOKEN_METHOD', 'fixed' );
		define( 'WCN_TOKEN', 'value' );
		define( 'WCN_NONCE_OFFSET', 0 );
		define( 'WCN_NONCE_LENGTH', 10 );

		\Brain\Monkey\Functions\expect( 'wp_nonce_tick' )->once()->andReturn( 1 );
		\Brain\Monkey\Functions\expect( 'wp_hash' )->times( 3 )->andReturnValues( [ 'a', 'b', 'a' ] );

		$test  = new \WCN\Wcn( 'action' );
		$nonce = $test->generate_nonce();
		$this->assertEquals( 2, $test->validate( $nonce ) );
	}

	public function testInvalidNonce() {
		define( 'WCN_VALIDATE_OLD_NONCES', false );
		define( 'WCN_UID_METHOD', 'fixed' );
		define( 'WCN_UID', 'value' );
		define( 'WCN_TOKEN_METHOD', 'fixed' );
		define( 'WCN_TOKEN', 'value' );
		define( 'WCN_NONCE_OFFSET', 0 );
		define( 'WCN_NONCE_LENGTH', 10 );

		\Brain\Monkey\Functions\expect( 'wp_nonce_tick' )->once()->andReturn( 1 );
		\Brain\Monkey\Functions\expect( 'wp_hash' )->twice()->andReturnValues( [ 'a', 'b' ] );

		$test  = new \WCN\Wcn( 'action' );
		$nonce = $test->generate_nonce();
		$this->assertFalse( $test->validate( $nonce ) );
	}

	public function testEmptyUid() {
		define( 'WCN_UID_METHOD', 'fixed' );
		define( 'WCN_UID', '' );

		$test = new \WCN\Wcn( 'action' );
		$test->get_uid();

		$this->assertTrue( \Brain\Monkey\Filters\applied( 'nonce_user_logged_out' ) > 0 );
	}

}