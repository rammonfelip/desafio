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

    /**
     * Utiliza a API do IEX Cloud para consultar os dados de uma Empresa
     * @param string $symbol
     * @return array|false|mixed
     */
    public function getCompany(string $symbol)
    {
        $urlPath = $this->url . sprintf('/stock/%s/company', $symbol);

        $request = Http::acceptJson()->get(
            $urlPath, [
                'token' => $this->token
            ]
        );

        return $request;
    }

    /**
     * Utiliza a API do IEX Cloud para consultar os dados de Cotação de uma Empresa, ou retorna apenas o campo solicitado.
     * @param string $symbol
     * @param string|null $field
     * @return array|false|mixed
     */
    public function getQuote(string $symbol, string $field = null)
    {
        $urlPath = $this->url . sprintf('/stock/%s/quote/%s', $symbol, $field);

        $request = Http::acceptJson()->get(
            $urlPath, [
                'token' => $this->token,
                'displayPercent' => true
            ]
        );

        return $request;
    }
}
