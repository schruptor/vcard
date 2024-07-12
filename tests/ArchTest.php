<?php

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

arch('every property must follow some conventsions')
    ->expect('Schruptor\Vcard\Properties')
    ->toImplement('Schruptor\Vcard\Properties\Base\PropertieContract')
    ->toExtend('Spatie\LaravelData\Data')
    ->ignoring('Schruptor\Vcard\Properties\Base\PropertieContract');
