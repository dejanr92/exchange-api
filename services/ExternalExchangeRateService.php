<?php

namespace Services;

use Exception;
use GuzzleHttp\Client;

class ExternalExchangeRateService {

	/**
	 * @param $client
	 */
	private $client;

	/**
	 * @param string $baseCurrency
	 */
	private $baseCurrency;

	/**
	 * __construct
	 */
	public function __construct($baseCurrency)
	{
		$this->baseCurrency = $baseCurrency;

		if(!isset($_ENV['EXCHANGE_API_URL']) || !isset($_ENV['EXCHANGE_API_TOKEN'])) {
			throw new Exception("The live feature is not confugired. Please use the static version!");
		}

		$this->client = new Client(
			[
				'base_uri'        => $_ENV['EXCHANGE_API_URL'] . $_ENV['EXCHANGE_API_TOKEN'] . '/',
				'timeout'         => $_ENV['EXCHANGE_API_TIMEOUT'],
			]
		);
		$this->cacheService = new CacheService();
	}

	/**
	 * calculateConversion
	 *
	 * @return double $calculatedValue
	 */
	public function calculateConversion($target, $value)
	{
		$rates = $this->getRates();

		return $rates->conversion_rates->{$target} * $value;
	}

	/**
	 * getRates
	 *
	 * @return stdClass $values
	 */
	private function getRates()
	{
		$body = $this->cacheService->getCacheValue('exchangeRates-' . $this->baseCurrency);

		if($body === null) {
			$response = $this->client->get('latest/' . $this->baseCurrency);
			$body = $response->getBody();
	
			$this->cacheService->putCacheValue('exchangeRates-' . $this->baseCurrency, $body);
		}
		
		return json_decode($body);
	}

}