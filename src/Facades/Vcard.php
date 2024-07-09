<?php

namespace Schruptor\Vcard\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Schruptor\Vcard\Vcard
 */
class Vcard extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Schruptor\Vcard\Vcard::class;
    }
}
