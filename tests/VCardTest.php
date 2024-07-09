<?php

use Schruptor\Vcard\Properties\Address;
use Schruptor\Vcard\Properties\Base\Begin;
use Schruptor\Vcard\Properties\Base\End;
use Schruptor\Vcard\Properties\EMail;
use Schruptor\Vcard\Properties\Phone;
use Schruptor\Vcard\Properties\Website;
use Schruptor\Vcard\Vcard;

it('a vcard can be cast to array', function () {
    expect((new Vcard())->toArray())->toHaveCount(2);
})->group('vcard');

it('a vcard can be serialized', function () {
    expect((new Vcard())->forceEnd('2026-06-16', '16:02:00')->serialize())
        ->toBeString()
        ->toBe(emptyVCard());
})->group('vcard');

it('a vcard has an beginning and a end', function () {
    $begin = Begin::from()->toArray();
    $end = End::from()->toArray();

    expect((new Vcard())->toArray())
        ->toContain($begin)
        ->toContain($end);
})->group('vcard');

it('a vcard can be validated', function () {
    $begin = Begin::from()->toArray();
    $end = End::from()->toArray();

    $vcard = new Vcard();

    $vcard->add(createNameProperty());

    $vcard->add(createNameProperty());

    $vcard->add(createEMailProperty());

    $vcard->add(createEMailProperty());

    expect($vcard->toArray())
        ->toHaveCount(4);
})->group('validate', 'vcard');

it('a complete vcard can be generated', function () {
    $vcard = (new Vcard())
        ->add(createImageProperty())
        ->add(createBirthdayProperty())
        ->add(createSourceProperty())
        ->add(createNameProperty())
        ->add(createBusinessProperty())
        ->add(createJobTitleProperty())
        ->add(createWebsiteProperty())
        ->add(Website::from([
            'url' => 'https://www.mustermann.de',
            'type' => 'PRIVATE',
        ]))
        ->add(createEMailProperty())
        ->add(Email::from([
            'email' => 'm.mustermann@musterfirma.de',
            'type' => 'INTERNET',
        ]))
        ->add(Email::from([
            'email' => 'maxi@musterfirma.de',
            'type' => 'INTERNET',
        ]))
        ->add(Email::from([
            'email' => 'max@mustermann.de',
            'type' => 'HOME',
        ]))
        ->add(Phone::from([
            'number' => '+49 098 1234567',
            'type' => 'WORK',
        ]))
        ->add(createPhoneProperty())
        ->add(createMobileProperty())
        ->add(createFaxProperty())
        ->add(Address::from([
            'street' => 'Musterstraße 1 a',
            'city' => 'Musterort',
            'zip' => '12345',
            'country' => 'Deutschland',
            'type' => 'WORK',
        ]))
        ->add(createAddressProperty())
        ->add(createNoteProperty())
        ->forceEnd('2016-06-26', '16:02:00');;

    expect($vcard->serialize())
        ->toBeString()
        ->toBe(completeVCard());
})->group('vcard');

it('a complete vcard can be downloaded', function () {
    $vcard = (new Vcard())
        ->add(createImageProperty())
        ->add(createBirthdayProperty())
        ->add(createSourceProperty())
        ->add(createNameProperty())
        ->add(createBusinessProperty())
        ->add(createJobTitleProperty())
        ->add(createWebsiteProperty())
        ->add(Website::from([
            'url' => 'https://www.mustermann.de',
            'type' => 'PRIVATE',
        ]))
        ->add(createEMailProperty())
        ->add(Email::from([
            'email' => 'm.mustermann@musterfirma.de',
            'type' => 'INTERNET',
        ]))
        ->add(Email::from([
            'email' => 'maxi@musterfirma.de',
            'type' => 'INTERNET',
        ]))
        ->add(Email::from([
            'email' => 'max@mustermann.de',
            'type' => 'HOME',
        ]))
        ->add(Phone::from([
            'number' => '+49 098 1234567',
            'type' => 'WORK',
        ]))
        ->add(createPhoneProperty())
        ->add(createMobileProperty())
        ->add(createFaxProperty())
        ->add(Address::from([
            'street' => 'Musterstraße 1 a',
            'city' => 'Musterort',
            'zip' => '12345',
            'country' => 'Deutschland',
            'type' => 'WORK',
        ]))
        ->add(createAddressProperty())
        ->add(createNoteProperty())
        ->forceEnd('2016-06-26', '16:02:00');

    expect(trim($vcard->response()->content()))
    ->toBe(completeVCard());
})->group('now');
