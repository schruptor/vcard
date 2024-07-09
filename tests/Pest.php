<?php

use Schruptor\Vcard\Properties\Address;
use Schruptor\Vcard\Properties\Birthday;
use Schruptor\Vcard\Properties\Business;
use Schruptor\Vcard\Properties\EMail;
use Schruptor\Vcard\Properties\Fax;
use Schruptor\Vcard\Properties\Image;
use Schruptor\Vcard\Properties\JobTitle;
use Schruptor\Vcard\Properties\Mobile;
use Schruptor\Vcard\Properties\Name;
use Schruptor\Vcard\Properties\Note;
use Schruptor\Vcard\Properties\Phone;
use Schruptor\Vcard\Properties\Source;
use Schruptor\Vcard\Properties\Website;
use Schruptor\Vcard\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

function createAddressProperty(): Address
{
    return Address::from([
        'street' => 'Musterstraße 1',
        'city' => 'Musterort',
        'zip' => '12345',
        'country' => 'Deutschland',
        'type' => 'HOME',
    ]);
}

function createBirthdayProperty(): Birthday
{
    return Birthday::from([
        'date' => '2016-06-26 16:02:00',
    ]);
}

function createBusinessProperty(): Business
{
    return Business::from([
        'name' => 'Musterfirma',
        'unit' => 'IT',
    ]);
}

function createEMailProperty(): EMail
{
    return Email::from([
        'email' => 'max@musterfirma.de',
        'type' => 'WORK',
    ]);
}

function createFaxProperty(): Fax
{
    return Fax::from([
        'number' => '+49 098 17654321',
        'type' => 'WORK',
    ]);
}

function createImageProperty(): Image
{
    return Image::fromPath(__DIR__.'/fixtures/image/blank.jpg');
}

function createJobTitleProperty(): JobTitle
{
    return JobTitle::from([
        'title' => 'Fachinformatiker für Anwendungsentwicklung',
    ]);
}

function createMobileProperty(): Mobile
{
    return Mobile::from([
        'number' => '+49 123 7654321',
    ]);
}

function createNameProperty(): Name
{
    return Name::from([
        'firstName' => 'Max Markus',
        'lastName' => 'Mustermann',
        'title' => 'Prof. Dr.',
        'nickname' => 'Maxi',
    ]);
}

function createNoteProperty(): Note
{
    return Note::from([
        'note' => 'This is a note.',
    ]);
}

function createPhoneProperty(): Phone
{
    return Phone::from([
        'number' => '+49 123 1234567',
        'type' => 'HOME',
    ]);
}

function createSourceProperty(): Source
{
    return Source::from([
        'url' => 'https://www.musterfirma.de/contact/maxi',
    ]);
}

function createWebsiteProperty(): Website
{
    return Website::from([
        'url' => 'https://www.musterfirma.de',
        'type' => 'WORK',
    ]);
}

function emptyVCard(): string
{
    return trim(file_get_contents(__DIR__.'/fixtures/empty.vcf'));
}

function completeVCard(): string
{
    return trim(file_get_contents(__DIR__.'/fixtures/complete.vcf'));
}

function getPropertyFixture(string $type): string
{
    $path = __DIR__.'/fixtures/property/'.$type;

    if (is_file($path)) {
        return trim(file_get_contents($path));
    }

    return '';
}

function getImageFixture(string $image): string
{
    $path = __DIR__.'/fixtures/image/'.$image;

    if (is_file($path)) {
        return trim(file_get_contents($path));
    }

    return '';
}
