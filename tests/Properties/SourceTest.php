<?php

use Schruptor\Vcard\Properties\Source;
use Schruptor\Vcard\Vcard;

it('a source property can be created', function () {
    expect(createSourceProperty())->toBeInstanceOf(Source::class);
});

test('a source property can be serialized', function () {
    expect(createSourceProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('source'));
});

test('a source property can be added to a vcard', function () {
    $source = createSourceProperty();

    $vcard = new Vcard();

    $vcard->add($source);

    expect($vcard->toArray())->toHaveCount(3)->toContain($source->toArray());
});
