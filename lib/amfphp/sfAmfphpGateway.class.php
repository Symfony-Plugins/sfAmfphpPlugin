<?php

class sfAmfphpGateway extends Gateway
{
	/**
	 * Setting the default error level to E_ALL ^ E_NOTICE
	 *
	 */
	const ERROR_LEVEL = 6135;
	
	/**
	 * Constructor, set default values
	 *
	 */
	public function __construct()
	{
		$isProductionServer = ('dev' !== sfConfig::get('sf_environment'));
		define('PRODUCTION_SERVER', $isProductionServer);

		parent::Gateway();
		
		$this->setClassPath(sfConfig::get('sf_lib_dir') . '/services/');
		$this->setErrorHandling(self::ERROR_LEVEL);
	}
}
