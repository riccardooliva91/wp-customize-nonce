<?php

namespace WCN;

/**
 * Interface FactoryInterface
 * @package WCN
 */
interface FactoryInterface {

	/**
	 * Get object
	 *
	 * @return mixed
	 *
	 * @throws \Exception
	 */
	public function get();

}