<?php

namespace Moriony\RpcClient\Protocol;

use Moriony\RpcClient\Request\HttpRequestInterface;
use Moriony\RpcClient\Request\RpcRequestInterface;
use Moriony\RpcClient\Response\HttpResponseInterface;
use Moriony\RpcClient\Response\RpcResponseInterface;

/**
 * Interface ProtocolInterface
 */
interface ProtocolInterface
{
    /**
     * @param RpcRequestInterface $request
     * @return HttpRequestInterface
     */
    public function createHttpRequest(RpcRequestInterface $request);

    /**
     * @param HttpResponseInterface $response
     * @return RpcResponseInterface
     */
    public function createRpcResponse(HttpResponseInterface $response);
}
