<?php

use Schruptor\Vcard\Properties\Address;
use Schruptor\Vcard\Vcard;

it('a address property can be created', function () {
    expect(createAddressProperty())->toBeInstanceOf(Address::class);
});

test('a address property can be serialized', function () {
    expect(createAddressProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('address'));
});

test('a address property can be added to a vcard', function () {
    $address = createAddressProperty();

    $vcard = new Vcard();

    $vcard->add($address);

    expect($vcard->toArray())->toHaveCount(3)->toContain($address->toArray());
});
