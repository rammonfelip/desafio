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

        $request = $this->api->getCompany($symbol);

        if ($request->successful()) {
            $company = $this->create($request->json());

            return $company;
        }

        abort(404, 'Não foi possível encontrar informações. Por favor, tente novamente. ');
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
            $request = $this->api->getQuote($symbol, 'latestUpdate');

            if ($request->successful() && $lastQuote->latestUpdate === $request->json()) {
                return $lastQuote;
            }
        }

        $request = $this->api->getQuote($symbol, $field);

        if ($request->successful()) {
            $quote  = Quote::create($request->json());

            return $quote;
        }

        abort(404, 'Não foi possível encontrar informações. Por favor, tente novamente. ');
    }
}
