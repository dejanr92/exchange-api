<?php

namespace Validators;

use Exception;

class ExchangeRequestValidator {

    /**
     * __construct
     */
	public function __construct()
	{
        $validCurrencies = explode(',', WORLD_CURRENCIES);

        if(!isset($_GET['target']) || !isset($_GET['source']) || !isset($_GET['amount'])) {
            throw new Exception("Please provide all requred fields : target, source, amount", 422);
        }

        if(!in_array($_GET['target'], $validCurrencies) || !in_array($_GET['source'], $validCurrencies)) {
            throw new Exception("Please select valid source and target currency codes", 422);
        }

        if(!is_numeric($_GET['amount'])) {
            throw new Exception("The amount must be a number", 422);
        }

        $this->target = $_GET['target'];
        $this->source = $_GET['source'];
        $this->amount = (double) $_GET['amount'];
        $this->live = isset($_GET['live']) && $_GET['live'] === 'true' ? true : false;
	}

    public function all()
    {
        return [
            'target' => $this->target,
            'source' => $this->source,
            'amount' => $this->amount,
            'live'   => $this->live
        ];
    }
}