<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IEXServices
{
    protected $url;
    protected $token;

    public function __construct()
    {
        $this->url   = env('IEX_BASE_URL');
        $this->token = env('IEX_TOKEN');
    }

    public function getCompany(string $symbol)
    {
        $urlPath = $this->url . sprintf('/stock/%s/company', $symbol);

        return Http::acceptJson()->get(
            $urlPath, [
                'token' => $this->token
            ]
        )->json();
    }

    public function getQuote(string $symbol, string $field = null)
    {
        $urlPath = $this->url . sprintf('/stock/%s/quote/%s', $symbol, $field);

        return Http::acceptJson()->get(
            $urlPath, [
                'token' => $this->token,
                'displayPercent' => true
            ]
        )->json();
    }
}
