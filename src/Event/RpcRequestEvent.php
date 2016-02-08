<?php

namespace Moriony\RpcClient\Event;

use Moriony\RpcClient\Request\RpcRequestInterface;
use Symfony\Component\EventDispatcher\Event;

class RpcRequestEvent extends Event
{
    protected $request;

    public function __construct(RpcRequestInterface $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }
}