<?php

use Services\RendererService;
use Services\ExternalExchangeRateService;
use Services\LocalExchangeRateService;
use Validators\ExchangeRequestValidator;

define('__ROOT_DIR__', dirname(__FILE__, 2));

require_once __ROOT_DIR__ . '/vendor/autoload.php';

$renderService = new RendererService();

// Validate the request input parameters
try {
	$exchangeRequest = new ExchangeRequestValidator();
	$requestData = $exchangeRequest->all();
	$data = $requestData;
} catch(Exception $e) {
	return $renderService->renderError($e->getMessage(), $e->getCode());
}

// Check if I should use the third party Currency Exchange
if($requestData['live'])
{
	try {
		$service = new ExternalExchangeRateService($requestData['source']);
		$data['calculatedAmount'] = $service->calculateConversion($requestData['target'], $requestData['amount']);

		return $renderService->renderSuccess($data);
	} catch (Exception $e) {
		return $renderService->renderError($e->getMessage(), $e->getCode());
	}	
}

// Use the localy defined Exchange Rates
try {
	$service = new LocalExchangeRateService();
	$data['calculatedAmount'] = $service->calculateConversion($requestData['source'], $requestData['target'], $requestData['amount']);

	return $renderService->renderSuccess($data);
} catch (Exception $e) {
	return $renderService->renderError($e->getMessage(), $e->getCode());
}

