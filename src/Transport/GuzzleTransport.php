<?php

namespace Moriony\RpcClient\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Moriony\RpcClient\Request\HttpRequestInterface;
use Moriony\RpcClient\Response\HttpResponse;
use Moriony\RpcClient\Response\HttpResponseInterface;

class GuzzleTransport implements TransportInterface
{
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param HttpRequestInterface $request
     * @return HttpResponseInterface
     */
    public function call(HttpRequestInterface $request)
    {
        $guzzleRequest = new Request('POST', $request->getUrl(), $request->getHeaders(), $request->getBody());

        $response = $this->client->send($guzzleRequest);

        $httpResponse = new HttpResponse();
        $httpResponse->setBody($response->getBody()->getContents());
        $httpResponse->setStatusCode($response->getStatusCode());
        $httpResponse->setHeaders($response->getHeaders());

        return $httpResponse;
    }
}
