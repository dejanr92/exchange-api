<?php

namespace Services;

use Predis\Client;

class CacheService {

	/**
	 * @param Predis\Client $redisClient
	 */
	private $redisClient;

    /**
     * __construct
     */
	public function __construct()
	{
		$this->redisClient = new Client(REDIS_CONFIG);
	}

    /**
     * getCacheValue
     *
     * @param string $key
     * @return string
     */
	public function getCacheValue($key)
	{
		return $this->redisClient->get($key);
	}

    /**
     * getCacheValue
     *
     * @param string $key
     * @param string $value
     * @param ?int $ttl
     * @return void
     */
	public function putCacheValue($key, $value, $ttl = null): void
	{
		$this->redisClient->set($key, $value, 'ex', $ttl ?? REDIS_CONFIG['ttl']);
	}
}