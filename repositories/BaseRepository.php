<?php

namespace Repositories;

use PDO;

class BaseRepository {

    protected $client;

    /**
	 * __construct
	 */
	public function __construct()
	{
        // print_r(DB_CONFIG); exit;
        $this->client = new PDO(DB_CONFIG['host'], DB_CONFIG['username'], DB_CONFIG['password'] );
        // var_dump($this->client); exit;
        $this->client->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->client->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // var_dump($this->client); exit;
	}


}