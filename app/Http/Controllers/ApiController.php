<?php

namespace App\Http\Controllers;

use App\Contracts\CompanyInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $company;

    public function __construct(CompanyInterface $company)
    {
        $this->company = $company;
    }

    public function getCotationInfo(Request $request)
    {
        $symbol = $request->input('symbol');

        $company = [
            'info'  => $this->company->show($symbol),
            'quote' => $this->company->getQuote($symbol)
        ];

        return $company;
    }

    public function getLatestPrice(Request $request)
    {
        $symbol = $request->input('symbol');

        $latestPrice = $this->company->getQuote($symbol, 'latestPrice');

        return $latestPrice;
    }
}
