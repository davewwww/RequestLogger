<?php

namespace Dwo\RequestLogger\Storage;

use Dwo\RequestLogger\Converter\HttpFoundationConverter;
use Dwo\RequestLogger\Factory\ReqresFactory;
use Dwo\RequestLogger\Reqres;

/**
 * Class LogDirStorage
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class LogFileStorage extends AbstractStorage
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var ReqresFactory
     */
    protected $factory;

    /**
     * LogFileStorage constructor.
     *
     * @param string             $path
     * @param ReqresFactory|null $factory
     */
    public function __construct($path, ReqresFactory $factory = null)
    {
        $this->path = $path;
        $this->factory = $factory ?: new ReqresFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function addEntry(Reqres $reqres)
    {
        $data = array(
            'request'  => HttpFoundationConverter::createArrayFromRequest($reqres->request),
            'response' => HttpFoundationConverter::createArrayFromResponse($reqres->response),
        );
        file_put_contents($this->path, json_encode($data).PHP_EOL, FILE_APPEND);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntries()
    {
        $entries = [];

        foreach (file($this->path) as $line) {
            $data = json_decode($line, 1);
            $request = HttpFoundationConverter::createRequestFromArray($data['request']);
            $response = HttpFoundationConverter::createResponseFromArray($data['response']);

            $entries[] = $this->factory->create($request, $response);
        }

        $this->clearDuplicates($entries);

        return $entries;
    }
}