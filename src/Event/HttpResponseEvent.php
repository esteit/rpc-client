<?php

namespace Moriony\RpcClient\Event;

use Moriony\RpcClient\Request\HttpRequestInterface;
use Moriony\RpcClient\Response\HttpResponseInterface;
use Symfony\Component\EventDispatcher\Event;

class HttpResponseEvent extends Event
{
    protected $request;
    protected $response;

    public function __construct(HttpRequestInterface $request, HttpResponseInterface $response)
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