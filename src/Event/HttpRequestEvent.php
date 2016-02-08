<?php

namespace Moriony\RpcClient\Event;

use Moriony\RpcClient\Request\HttpRequestInterface;
use Symfony\Component\EventDispatcher\Event;

class HttpRequestEvent extends Event
{
    protected $request;

    public function __construct(HttpRequestInterface $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}