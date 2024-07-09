<?php

use Schruptor\Vcard\Properties\Note;
use Schruptor\Vcard\Vcard;

it('a note property can be created', function () {
    expect(createNoteProperty())->toBeInstanceOf(Note::class);
});

test('a note property can be serialized', function () {
    expect(createNoteProperty()->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('note'));
});

test('a note property can be added to a vcard', function () {
    $note = createNoteProperty();

    $vcard = new Vcard();

    $vcard->add($note);

    expect($vcard->toArray())->toHaveCount(3)->toContain($note->toArray());
});
