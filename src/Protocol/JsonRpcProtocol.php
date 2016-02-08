<?php

namespace Moriony\RpcClient\Protocol;

use Moriony\RpcClient\Exception\InvalidArgumentException;
use Moriony\RpcClient\Request\HttpRequest;
use Moriony\RpcClient\Request\HttpRequestInterface;
use Moriony\RpcClient\Request\RpcRequestInterface;
use Moriony\RpcClient\Response\HttpResponseInterface;
use Moriony\RpcClient\Response\JsonRpcResponse;

/**
 * class JsonRpcProtocol
 */
class JsonRpcProtocol implements ProtocolInterface
{
    /**
     * @param RpcRequestInterface $request
     * @return HttpRequestInterface
     */
    public function createHttpRequest(RpcRequestInterface $request)
    {
        $data = [
            'jsonrpc' => '2.0',
            'method' => $request->getMethod(),
            'params' => $request->getParams(),
            'id' => uniqid('', true),
        ];

        $body = @json_encode($data);
        if (!$body) {
            throw new InvalidArgumentException('Invalid request data.');
        }

        $httpRequest = new HttpRequest();
        $httpRequest->setHeaders($request->getHeaders());
        $httpRequest->setHeader('Content-Type', 'application/json');
        $httpRequest->setUrl($request->getUrl());
        $httpRequest->setBody($body);

        return $httpRequest;
    }

    /**
     * @param HttpResponseInterface $response
     * @return JsonRpcResponse
     */
    public function createRpcResponse(HttpResponseInterface $response)
    {
        $data = @json_decode($response->getBody(), true);

        if (!is_array($data)) {
            throw new InvalidArgumentException('Invalid http response body.');
        }

        $rpcResponse = new JsonRpcResponse();

        if (array_key_exists('jsonrpc', $data)) {
            $rpcResponse->setProtocolVersion($data['jsonrpc']);
        }

        if (array_key_exists('error', $data)) {
            if (array_key_exists('code', $data['error'])) {
                $rpcResponse->setErrorCode($data['error']['code']);
            }
            if (array_key_exists('message', $data['error'])) {
                $rpcResponse->setErrorMessage($data['error']['message']);
            }
        }

        if (array_key_exists('id', $data)) {
            $rpcResponse->setId($data['id']);
        }

        if (array_key_exists('result', $data)) {
            $rpcResponse->setResult($data['result']);
        }

        return $rpcResponse;
    }
}
