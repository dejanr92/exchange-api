<?php

namespace Services;

use Exception;

class LocalExchangeRateService {

	/**
	 * calculateConversion
	 *
	 * @return double $calculatedValue
	 */
	public function calculateConversion($source, $target, $value)
	{
		// Build the Exchange Rate Key
        $key = $source . ':' . $target;
        if(isset(EXCHANGE_RATES[$key])) 
        {
            return EXCHANGE_RATES[$key] * $value;
        }

        // The exchange rate doesn't exist in the asked direction. Check if reverse exchange rate is available
        $reverseKey = $target . ':' . $source;
        if(isset(EXCHANGE_RATES[$reverseKey])) 
        {
            return $value / EXCHANGE_RATES[$reverseKey];
        }

        throw new Exception("Unavailable currency rates!", 424);

	}


}