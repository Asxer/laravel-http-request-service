<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 06.05.16
 * Time: 16:46
 */

namespace App\Tests\Support;

use Asxer\Services\HttpRequestService;
use GuzzleHttp\ClientInterface;
use Mockery;

trait MockHttpRequestTrait
{
    public function setResponse($response, $http = null) {
        return $this->makeGetRequest($this->makeResponse($response), $http);
    }

    public function makeGetRequest($response, $http = null) {
        if (empty($http)) {
            $http = Mockery::mock(HttpRequestService::class);
        }

        $http->shouldReceive('sendGet')->once()->andReturn($response);

        return $http;
    }

    public function makeResponse($body = null) {
        $httpResponse = Mockery::mock(ClientInterface::class);
        $httpResponse->shouldReceive('isSuccessful')->andReturn(true);
        $httpResponse->shouldReceive('getBody')->andReturn($body);

        return $httpResponse;
    }
}