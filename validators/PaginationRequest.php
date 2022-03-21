<?php

namespace Validators;

use Exception;

class PaginationRequest {

    /**
     * __construct
     */
	public function __construct()
	{
        $this->limit = $_GET['limit'] ?? 20;
        $this->page = isset($_GET['page']) ? $_GET['page'] - 1 : 0;
        $this->offset = $this->page * $this->limit;

        if(!is_numeric($this->limit)) {
            throw new Exception("The limit must be a number", 422);
        }
        if(!is_numeric($this->page)) {
            throw new Exception("The page must be a number", 422);
        }


	}

    public function all()
    {
        return [
            'limit' => $this->limit,
            'page' => $this->page,
            'offset' => $this->offset,
        ];
    }
}