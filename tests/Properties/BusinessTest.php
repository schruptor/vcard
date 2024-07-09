<?php

use Schruptor\Vcard\Properties\Birthday;
use Schruptor\Vcard\Vcard;

it('a business property can be created', function () {
    expect(createBirthdayProperty())->toBeInstanceOf(Birthday::class);
});

test('a business property can be serialized', function () {
    expect(createBirthdayProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('birthday'));
});

test('a business property can be added to a vcard', function () {
    $birthday = createBirthdayProperty();

    $vcard = new Vcard();

    $vcard->add($birthday);

    expect($vcard->toArray())->toHaveCount(3)->toContain($birthday->toArray());
});
