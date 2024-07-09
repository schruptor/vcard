<?php

use Schruptor\Vcard\Properties\Website;
use Schruptor\Vcard\Vcard;

it('a website property can be created', function () {
    expect(createWebsiteProperty())->toBeInstanceOf(Website::class);
});

test('a website property can be serialized', function () {
    expect(createWebsiteProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('website'));
});

test('a website property can be added to a vcard', function () {
    $website = createSourceProperty();

    $vcard = new Vcard();

    $vcard->add($website);

    expect($vcard->toArray())->toHaveCount(3)->toContain($website->toArray());
});
