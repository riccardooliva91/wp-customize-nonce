<?php

namespace WCN\Tests\WCN\Elements;

use WCN\Tests\WCN_TestCase;

/**
 * Class DefaultUidTest
 * @package WCN\Tests\WCN\Elements
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class DefaultUidTest extends WCN_TestCase {

	public function testuserLoggedIn() {
		\Brain\Monkey\Functions\expect( 'wp_get_current_user' )->once()->andReturn( (object) [ 'ID' => 100 ] );
		$test = new \WCN\Elements\DefaultUid();

		$this->assertEquals( 100, $test->get() );
	}

	public function testuserLoggedOut() {
		\Brain\Monkey\Functions\expect( 'wp_get_current_user' )->once()->andReturnNull();
		$test = new \WCN\Elements\DefaultUid();

		$this->assertEquals( 0, $test->get() );
	}

}