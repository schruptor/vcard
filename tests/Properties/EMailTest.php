<?php

use Schruptor\Vcard\Properties\EMail;
use Schruptor\Vcard\Vcard;

it('a email property can be created', function () {
    expect(createEMailProperty())->toBeInstanceOf(EMail::class);
});

test('a email property can be serialized', function () {
    expect(createEMailProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('email'));
});

test('a email property can be added to a vcard', function () {
    $email = createEMailProperty();

    $vcard = new Vcard();

    $vcard->add($email);

    expect($vcard->toArray())->toHaveCount(3)->toContain($email->toArray());
});
