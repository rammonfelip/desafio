<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyInterface;
use App\Services\IEXServices;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $company;
    private $api;

    public function __construct(CompanyInterface $company, IEXServices $api)
    {
        $this->company = $company;
        $this->api = $api;
    }

    public function getCotationInfo(Request $request)
    {
        $symbol = $request->input('symbol');

        $company = $this->company->show($symbol);
        $quote   = $this->company->getQuote($symbol);

        return response()->json([
            'data'  =>  [
                'success'   =>  true,
                'info'   =>  $company,
                'quote' =>  $quote
            ]
        ], 200);
    }

    public function getLatestPrice(Request $request)
    {
        $symbol = $request->input('symbol');

        $latestPrice = $this->company->getQuote($symbol, 'latestPrice');

        return $latestPrice;
    }

    public function getCompanyInfo(string $symbol)
    {
        return $this->api->getCompany($symbol);
    }

    public function getQuoteInfo(string $symbol, string $field = null)
    {
        return $this->api->getQuote($symbol, $field);
    }
}
