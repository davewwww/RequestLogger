<?php

namespace Dwo\RequestLogger\Storage;

use Dwo\RequestLogger\Converter\HttpFoundationConverter;
use Dwo\RequestLogger\Reqres;

/**
 * Class AbstractStorage
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
abstract class AbstractStorage implements StorageInterface
{
    /**
     * @param Reqres[] $requestEntries
     */
    protected function clearDuplicates(array &$requestEntries)
    {
        $hashes = [];
        foreach ($requestEntries as $k => $requestEntry) {
            $data = array(
                HttpFoundationConverter::createArrayFromRequest($requestEntry->request),
                HttpFoundationConverter::createArrayFromResponse($requestEntry->response),
            );
            $hash = md5(json_encode($data));
            if (in_array($hash, $hashes)) {
                unset($requestEntries[$k]);
            }
            $hashes[] = $hash;
        }
    }
}