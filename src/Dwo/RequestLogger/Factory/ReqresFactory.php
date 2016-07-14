<?php

namespace Dwo\RequestLogger\Factory;

use Dwo\RequestLogger\Reqres;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ReqresFactory
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class ReqresFactory
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Reqres
     */
    public static function create(Request $request, Response $response)
    {
        return new Reqres($request, $response);
    }
}