<?php

use Schruptor\Vcard\Properties\Phone;
use Schruptor\Vcard\Vcard;

it('a phone property can be created', function () {
    expect(createPhoneProperty())->toBeInstanceOf(Phone::class);
});

test('a phone property can be serialized', function () {
    expect(createPhoneProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('phone'));
});

test('a phone property can be added to a vcard', function () {
    $phone = createPhoneProperty();

    $vcard = new Vcard();

    $vcard->add($phone);

    expect($vcard->toArray())->toHaveCount(3)->toContain($phone->toArray());
});
