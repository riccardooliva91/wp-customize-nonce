<?php

namespace WCN\Tests\WCN\Factories;

use WCN\Tests\WCN_TestCase;

/**
 * Class FactoriesTest
 * @package WCN\Tests\WCN\Factories
 *
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class FactoriesTest extends WCN_TestCase {

	public function testDefault() {
		define( 'WCN_UID_METHOD', 'default' );
		define( 'WCN_TOKEN_METHOD', 'default' );
		$test = new \WCN\Factories\TokenFactory();
		$this->assertInstanceOf( \WCN\Elements\DefaultSessionToken::class, $test->get() );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\DefaultUid::class, $test->get() );
	}

	public function testIp() {
		define( 'WCN_UID_METHOD', 'ip' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\Ip::class, $test->get() );
	}

	public function testNone() {
		define( 'WCN_UID_METHOD', 'none' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\EmptyElement::class, $test->get() );
	}

	public function testUrlParam() {
		define( 'WCN_UID_METHOD', 'url_param' );
		define( 'WCN_UID_URL_PARAMETER_NAME', 'param' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\UrlParameter::class, $test->get() );
	}

	public function testUrlParamError() {
		$this->expectException( \WCN\Exceptions\UndefinedOrEmptyConstant::class );
		define( 'WCN_UID_METHOD', 'url_param' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\UrlParameter::class, $test->get() );
	}

	public function testCookie() {
		define( 'WCN_UID_METHOD', 'cookie' );
		define( 'WCN_UID_COOKIE_NAME', 'cookie_name' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\Cookie::class, $test->get() );
	}

	public function testCookieError() {
		$this->expectException( \WCN\Exceptions\UndefinedOrEmptyConstant::class );
		define( 'WCN_UID_METHOD', 'cookie' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\Cookie::class, $test->get() );
	}

	public function testFixed() {
		define( 'WCN_UID_METHOD', 'fixed' );
		define( 'WCN_UID', 'value' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\Value::class, $test->get() );
	}

	public function testFixedError() {
		$this->expectException( \WCN\Exceptions\UndefinedOrEmptyConstant::class );
		define( 'WCN_UID_METHOD', 'fixed' );

		$test = new \WCN\Factories\UidFactory();
		$this->assertInstanceOf( \WCN\Elements\Value::class, $test->get() );
	}

	public function testNotSet() {
		$this->expectException( \WCN\Exceptions\UndefinedOrEmptyConstant::class );

		( new \WCN\Factories\UidFactory() )->get();
	}

	public function testNotValud() {
		$this->expectException( \WCN\Exceptions\InvalidConstantValue::class );
		define( 'WCN_UID_METHOD', 'aaa' );

		( new \WCN\Factories\UidFactory() )->get();
	}

}