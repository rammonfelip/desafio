<?php

namespace App\Contracts;

use App\Models\Company;

interface CompanyInterface
{
    public function show($symbol);

    public function create($data);

    public function getQuote($symbol, $field = null);
}
