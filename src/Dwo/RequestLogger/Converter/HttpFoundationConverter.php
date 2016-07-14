<?php

namespace Dwo\RequestLogger\Converter;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HttpFoundationConverter
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class HttpFoundationConverter
{
    /**
     * @param array $request
     *
     * @return Request
     */
    public static function createRequestFromArray(array $request)
    {
        return Request::create(
            $request['uri'],
            $request['method'],
            $request['parameters'],
            [],
            [],
            $request['server'],
            $request['content']
        );
    }

    /**
     * @param array $response
     *
     * @return Response
     */
    public static function createResponseFromArray(array $response)
    {
        return Response::create(
            $response['content'],
            $response['status'],
            $response['headers']
        );
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public static function createArrayFromRequest(Request $request)
    {
        return array(
            'method'     => $request->getMethod(),
            'uri'        => $request->getUri(),
            'parameters' => array_merge($request->query->all(), $request->request->all()),
            'server'     => $request->server->all(),
            'content'    => $request->getContent(),
        );
    }

    /**
     * @param Response $response
     *
     * @return array
     */
    public static function createArrayFromResponse(Response $response)
    {
        return array(
            'status'  => $response->getStatusCode(),
            'headers' => $response->headers->all(),
            'content' => $response->getContent(),
        );
    }

}