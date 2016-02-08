<?php

namespace Moriony\RpcClient\Response;

/**
 * Interface HttpResponseInterface
 */
interface HttpResponseInterface
{
    /**
     * @return string
     */
    public function getBody();

    /**
     * @return int
     */
    public function getStatusCode();

    /**
     * @return array
     */
    public function getHeaders();
}
