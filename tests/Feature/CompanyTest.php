<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_check_if_api_worker_correctly()
    {
        $route = route('api.company-info', 'meta');
        $response = $this->get($route);
        $response->assertStatus(200);
    }

    public function test_check_if_symbol_exist()
    {
        $route = route('api.company-info', 'arestdf');
        $response = $this->get($route);

        $response->assertSeeText('Unknown symbol');
    }


    public function test_if_company_response_contains_data()
    {
        $route = route('api.company-info', 'meta');
        $response = $this->get($route);
        $data = [
            'symbol', 'companyName', 'exchange', 'industry', 'website', 'description', 'CEO', 'securityName', 'issueType',
            'sector', 'primarySicCode', 'employees', 'tags', 'address', 'address2', 'state', 'city', 'zip', 'country', 'phone',
        ];

        $response->assertJsonStructure($data);
    }

    public function test_if_api_return_lastest_price()
    {
        $route = route('api.company-quote', 'meta', 'latestPrice');
        $response = $this->get($route);
        $response->assertStatus(200);
    }
}
