<?php

namespace Schruptor\Vcard\Properties\Base;

interface PropertieContract
{
    public function serialize(): string;

    public function getClass(): string;
}
