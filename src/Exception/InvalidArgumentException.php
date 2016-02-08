<?php

namespace Moriony\RpcClient\Exception;

/**
 * Class InvalidArgumentException
 */
class InvalidArgumentException extends \InvalidArgumentException implements RpcClientExceptionInterface
{
    protected $message = 'Invalid argument exception.';
}
