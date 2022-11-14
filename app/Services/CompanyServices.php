<?php

namespace App\Services;

use App\Contracts\CompanyInterface;
use App\Models\Company;
use App\Models\Quote;
use function PHPUnit\Framework\throwException;

class CompanyServices implements CompanyInterface
{
    private $model;
    private $api;

    public function __construct(IEXServices $api)
    {
        $this->api   = $api;
    }

    /**
     * Verifica se a empresa solicitada está cadastrada no banco e retorna a empresa.
     * Caso contrário, busca os dados na API IEX Cloud, cria o registro e retorna a empresa.
     *
     * @param string $symbol
     * @return mixed
     */
    public function show(string $symbol)
    {
        $company = Company::find($symbol);

        if ($company) {
            return $company;
        }

        $companyData = $this->api->getCompany($symbol);

        if (! $companyData) {
            abort(404, 'Não foi possível encontrar informações. Por favor, tente novamente. ');
        }

        $company = $this->create($companyData);

        return $company;
    }

    /**
     * Cria um novo registro de empresa no banco de dados.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Company::create($data);
    }

    /**
     * Consulta as informações de ações da empresa.
     * Esse método realiza uma consulta da última ação cadastrada e faz uma consulta na API para checar se as
     * informações foram atualizadas, evitando repetição no banco de dados.
     *
     * @param string $symbol
     * @param string|null $field
     * @return mixed
     */
    public function getQuote(string $symbol, string $field = null)
    {
        $lastQuote = Quote::where('symbol', $symbol)->latest()->first();

        if ($lastQuote) {
            $lastUpdated = $this->api->getQuote($symbol, 'latestUpdate');

            if ($lastUpdated && $lastQuote->latestUpdate === $lastUpdated) {
                return $lastQuote;
            }
        }

        $quoteData = $this->api->getQuote($symbol, $field);

        if (! $quoteData) {
            abort(404, 'Não foi possível encontrar informações. Por favor, tente novamente. ');
        }

        $quote  = Quote::create($quoteData);

        return $quote;
    }
}
