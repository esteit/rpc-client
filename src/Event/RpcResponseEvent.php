<?php

namespace Moriony\RpcClient\Event;

use Moriony\RpcClient\Request\RpcRequestInterface;
use Moriony\RpcClient\Response\RpcResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class RpcResponseEvent extends Event
{
    protected $request;
    protected $response;

    public function __construct(RpcRequestInterface $request, RpcResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
