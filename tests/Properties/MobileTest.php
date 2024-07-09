<?php

use Schruptor\Vcard\Properties\Mobile;
use Schruptor\Vcard\Vcard;

it('a mobile property can be created', function () {
    expect(createMobileProperty())->toBeInstanceOf(Mobile::class);
});

test('a mobile property can be serialized', function () {
    expect(createMobileProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('mobile'));
});

test('a mobile property can be added to a vcard', function () {
    $mobile = createMobileProperty();

    $vcard = new Vcard();

    $vcard->add($mobile);

    expect($vcard->toArray())->toHaveCount(3)->toContain($mobile->toArray());
});
