<?php

namespace App\Contracts;

use App\Models\Company;

interface CompanyInterface
{
    /**
     * Verifica se a empresa solicitada está cadastrada no banco e retorna a empresa.
     * Caso contrário, busca os dados na API IEX Cloud, cria o registro e retorna a empresa.
     *
     * @param string $symbol
     * @return mixed
     */
    public function show(string $symbol);

    /**
     * Cria um novo registro de empresa no banco de dados.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Consulta as informações de ações da empresa.
     * Esse método realiza uma consulta da última ação cadastrada e faz uma consulta na API para checar se as
     * informações foram atualizadas, evitando repetição no banco de dados.
     *
     * @param string $symbol
     * @param string|null $field
     * @return mixed
     */
    public function getQuote(string $symbol, string $field = null);
}
