<?php

namespace Services;

class RendererService {

    /**
     * __construct
     */
	public function __construct()
	{
		header('Content-Type: application/json; charset=utf-8');
	}

    /**
     * renderSuccess
     *
     * @param mixed $data
     * @return void
     */
	public function renderSuccess($data): void
	{
        http_response_code(200);
		echo json_encode($data);
        return;
	}

    /**
     * renderError
     *
     * @param mixed $error
     * @param int $code
     * @return void
     */
	public function renderError($error, int $code = 422): void
	{
		http_response_code($code);
		echo json_encode(['error' => $error]);
        return;
	}
}