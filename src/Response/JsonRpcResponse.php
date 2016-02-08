<?php

namespace Moriony\RpcClient\Response;

/**
 * Class JsonRpcResponse
 */
class JsonRpcResponse implements RpcResponseInterface
{
    protected $protocolVersion;
    protected $errorCode;
    protected $errorMessage;
    protected $result;
    protected $id;

    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function setProtocolVersion($version)
    {
        return $this->protocolVersion = $version;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorCode($code)
    {
        return $this->errorCode = $code;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($message)
    {
        return $this->errorMessage = $message;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        return $this->result = $result;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }
}
