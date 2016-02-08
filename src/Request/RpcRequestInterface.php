<?php

namespace Moriony\RpcClient\Request;

/**
 * Interface RpcRequestInterface
 */
interface RpcRequestInterface
{
    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return array
     */
    public function getParams();

    /**
     * @return string
     */
    public function getProtocol();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return array
     */
    public function getHeaders();
}
