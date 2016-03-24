<?php

namespace Moriony\RpcClient;

use Moriony\RpcClient\Event\Events;
use Moriony\RpcClient\Event\HttpRequestEvent;
use Moriony\RpcClient\Event\HttpResponseEvent;
use Moriony\RpcClient\Event\RpcRequestEvent;
use Moriony\RpcClient\Event\RpcResponseEvent;
use Moriony\RpcClient\Exception\InvalidArgumentException;
use Moriony\RpcClient\Protocol\ProtocolInterface;
use Moriony\RpcClient\Request\RpcRequestInterface;
use Moriony\RpcClient\Response\RpcResponseInterface;
use Moriony\RpcClient\Transport\TransportInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Client
 */
class Client
{
    protected $options;

    public function __construct(array $options)
    {
        $resolver = new OptionsResolver();

        $resolver
            ->setRequired([
                'transport',
                'dispatcher',
                'protocols',
            ])
            ->setDefault('dispatcher', new EventDispatcher())
            ->setAllowedTypes('dispatcher', EventDispatcherInterface::class)
            ->setAllowedTypes('transport', TransportInterface::class);

        $this->options = $resolver->resolve($options);
    }

    /**
     * @return TransportInterface
     */
    public function getTransport()
    {
        return $this->options['transport'];
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getDispatcher()
    {
        return $this->options['dispatcher'];
    }

    /**
     * @return ProtocolInterface[]
     */
    public function getProtocols()
    {
        return $this->options['protocols'];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasProtocol($name)
    {
        return array_key_exists($name, $this->options['protocols']);
    }

    /**
     * @param string $name
     * @return ProtocolInterface
     */
    public function getProtocol($name)
    {
        if (!$this->hasProtocol($name)) {
            throw new InvalidArgumentException('Undefined protocol.');
        }

        return $this->options['protocols'][$name];
    }

    /**
     * @param RpcRequestInterface $request
     * @return RpcResponseInterface
     */
    public function call(RpcRequestInterface $request)
    {
        $this->getDispatcher()->dispatch(Events::RPC_REQUEST, new RpcRequestEvent($request));

        $protocol = $this->getProtocol($request->getProtocol());
        $httpRequest = $protocol->createHttpRequest($request);
        $this->getDispatcher()->dispatch(Events::HTTP_REQUEST, new HttpRequestEvent($httpRequest));

        $httpResponse = $this->getTransport()->call($httpRequest);
        $this->getDispatcher()->dispatch(Events::HTTP_RESPONSE, new HttpResponseEvent($httpRequest, $httpResponse));

        $response = $protocol->createRpcResponse($httpResponse);
        $this->getDispatcher()->dispatch(Events::RPC_RESPONSE, new RpcResponseEvent($request, $response));

        return $response;
    }
}
