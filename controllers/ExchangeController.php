<?php

namespace Controllers;

use Exception;
use Services\LocalExchangeRateService;
use Validators\ExchangeRequestValidator;
use Services\ExternalExchangeRateService;
use Traits\RenderableTrait;

class ExchangeController {

    use RenderableTrait;

    public static function index()
    {
        try {
            $exchangeRequest = new ExchangeRequestValidator();
            $requestData = $exchangeRequest->all();
            $data = $requestData;
        } catch(Exception $e) {
            return self::renderError($e->getMessage(), $e->getCode());
        }
        
        // Check if I should use the third party Currency Exchange
        if($requestData['live'])
        {
            try {
                $service = new ExternalExchangeRateService($requestData['source']);
                $data['calculatedAmount'] = $service->calculateConversion($requestData['target'], $requestData['amount']);
        
                return self::renderSuccess($data);
            } catch (Exception $e) {
                return self::renderError($e->getMessage(), $e->getCode());
            }	
        }
        
        // Use the localy defined Exchange Rates
        try {
            $service = new LocalExchangeRateService();
            $data['calculatedAmount'] = $service->calculateConversion($requestData['source'], $requestData['target'], $requestData['amount']);
        
            return self::renderSuccess($data);
        } catch (Exception $e) {
            return self::renderError($e->getMessage(), $e->getCode());
        }
    }
}