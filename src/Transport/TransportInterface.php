<?php

namespace Moriony\RpcClient\Transport;

use Moriony\RpcClient\Request\HttpRequestInterface;
use Moriony\RpcClient\Response\HttpResponseInterface;

interface TransportInterface
{
    /**
     * @param HttpRequestInterface $request
     * @return HttpResponseInterface
     */
    public function call(HttpRequestInterface $request);
}