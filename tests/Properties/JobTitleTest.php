<?php

use Schruptor\Vcard\Properties\JobTitle;
use Schruptor\Vcard\Vcard;

it('a jobtitle property can be created', function () {
    expect(createJobTitleProperty())->toBeInstanceOf(JobTitle::class);
});

test('a jobtitle property can be serialized', function () {
    expect(createJobTitleProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('jobtitle'));
});

test('a jobtitle property can be added to a vcard', function () {
    $jobtitle = createJobTitleProperty();

    $vcard = new Vcard();

    $vcard->add($jobtitle);

    expect($vcard->toArray())->toHaveCount(3)->toContain($jobtitle->toArray());
});
