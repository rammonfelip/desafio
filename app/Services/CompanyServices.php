<?php

namespace App\Services;

use App\Contracts\CompanyInterface;
use App\Models\Company;
use App\Models\Quote;

class CompanyServices implements CompanyInterface
{
    private $model;
    private $api;

    public function __construct(IEXServices $api)
    {
        $this->api   = $api;
    }

    public function show($symbol)
    {
        $company = Company::find($symbol);

        if ($company) {
            return $company;
        }

        try {
            $companyData = $this->api->getCompany($symbol);
            $company = $this->create($companyData);

            return $company;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function create($data)
    {
        return Company::create($data);
    }

    public function getQuote($symbol, $field = null)
    {
        $lastQuote = Quote::where('symbol', $symbol)->latest()->first();

        if ($lastQuote) {
            //Check if Quote was changed in API
            $lastUpdated = $this->api->getQuote($symbol, 'latestUpdate');

            if ($lastQuote->latestUpdate === $lastUpdated) {
                return $lastQuote;
            }
        }

        $quoteData = $this->api->getQuote($symbol, $field);
        $quote  = Quote::create($quoteData);

        return $quote;
    }
}
