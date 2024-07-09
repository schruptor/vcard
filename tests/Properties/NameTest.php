<?php

use Schruptor\Vcard\Properties\Name;
use Schruptor\Vcard\Vcard;

it('a name property can be created', function () {
    expect(createNameProperty())->toBeInstanceOf(Name::class);
});

test('a name property can be serialized', function () {
    expect(createNameProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('name'));
});

test('a name property can be added to a vcard', function () {
    $name = createNameProperty();

    $vcard = new Vcard();

    $vcard->add($name);

    expect($vcard->toArray())->toHaveCount(3)->toContain($name->toArray());
});
