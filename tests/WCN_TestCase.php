<?php

namespace WCN\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class WCN_TestCase
 * @package WCN\Tests
 */
abstract class WCN_TestCase extends TestCase {

	public function setUp(): void {
		\Brain\Monkey\setUp();
		parent::setUp();
	}

	public function tearDown(): void {
		\Brain\Monkey\tearDown();
		parent::tearDown();
	}

}
