<?php

namespace App\ExternalApi\Spc;

interface SpcApiContract
{
    /**
     * Return true if the document is clean
     *
     * @param string $type - [F]isica ou [J]uridica
     * @param string $document
     * @return bool
     * @throws \Exception
     */
    public function isClean(string $type, string $document): bool;

    /**
     * Return the last full/unparsed response from the isClean method
     * @return array
     */
    public function getLastFullResponse(): array;

    /**
     * Return the last error from the isClean method
     * @return string
     */
    public function getLastError(): string;
}