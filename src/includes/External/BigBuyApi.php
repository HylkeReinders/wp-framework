<?php

namespace CoffeePlugins\Framework\External;

class BigBuyApi {
    const BASE_URL = "https://api.sandbox.bigbuy.eu";

    const BASE_FORMAT = "json";
    
    const BASE_ISO_CODE = "en";

    protected $bigBuyApiKey = '';

    public function __construct($apiKey)
    {
        $this->bigBuyApiKey = $apiKey;
    }
}