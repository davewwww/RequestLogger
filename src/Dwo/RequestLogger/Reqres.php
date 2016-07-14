<?php

namespace Dwo\RequestLogger;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Reqres
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Reqres
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var Response
     */
    public $response;

    /**
     * @param Request|null  $request
     * @param Response|null $response
     */
    public function __construct(Request $request = null, Response $response = null)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->request->getBasePath();
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->request->getMethod();
    }
}