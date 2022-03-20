<?php

namespace Traits;

trait RenderableTrait {

    /**
     * renderSuccess
     *
     * @param mixed $data
     * @return void
     */
	protected static function renderSuccess($data): void
	{
        header('Content-Type: application/json; charset=utf-8');
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
	protected static function renderError($error, int $code = 422): void
	{
        header('Content-Type: application/json; charset=utf-8');
		http_response_code($code);
		echo json_encode(['error' => $error]);
        return;
	}


    /**
     * renderError
     *
     * @param mixed $error
     * @param int $code
     * @return void
     */
	protected static function redirectToPage($string): void
	{
        header(sprintf("Location: %s", $string));
        return;
	}
}