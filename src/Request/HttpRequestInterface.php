<?php

namespace Moriony\RpcClient\Request;

/**
 * Interface HttpRequestInterface
 */
interface HttpRequestInterface
{
    /**
     * @return string
     */
    public function getBody();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return array
     */
    public function getHeaders();
}
