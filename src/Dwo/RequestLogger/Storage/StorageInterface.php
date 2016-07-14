<?php

namespace Dwo\RequestLogger\Storage;

use Dwo\RequestLogger\Reqres;

/**
 * Interface StorageInterface
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface StorageInterface
{
    /**
     * @param Reqres $reqres
     */
    function addEntry(Reqres $reqres);

    /**
     * @return Reqres[]
     */
    function getEntries();
}