<?php

use Schruptor\Vcard\Properties\Fax;
use Schruptor\Vcard\Vcard;

it('a fax property can be created', function () {
    expect(createFaxProperty())->toBeInstanceOf(Fax::class);
});

test('a fax property can be serialized', function () {
    expect(createFaxProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('fax'));
});

test('a fax property can be added to a vcard', function () {
    $fax = createFaxProperty();

    $vcard = new Vcard();

    $vcard->add($fax);

    expect($vcard->toArray())->toHaveCount(3)->toContain($fax->toArray());
});
