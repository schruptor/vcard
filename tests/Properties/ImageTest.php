<?php

use Schruptor\Vcard\Properties\Image;
use Schruptor\Vcard\Vcard;

it('a image property can be created', function () {
    $imageJpg = Image::from([
        'base64' => base64_encode(getImageFixture('blank.jpg')),
        'type' => 'jpg',
    ]);

    $imageOPng = Image::from([
        'base64' => base64_encode(getImageFixture('blank.png')),
        'type' => 'png',
    ]);

    expect($imageJpg)->toBeInstanceOf(Image::class)
        ->and($imageOPng)->toBeInstanceOf(Image::class);
});

test('a image property can be serialized', function () {
    $imageJpg = Image::from([
        'base64' => base64_encode(getImageFixture('blank.jpg')),
        'type' => 'jpg',
    ]);
    $imagePng = Image::from([
        'base64' => base64_encode(getImageFixture('blank.png')),
        'type' => 'png',
    ]);

    expect($imageJpg->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('image_jpg'))
        ->and($imagePng->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('image_png'));
});

test('a image property can be serialized with a path', function () {
    $imageJpg = Image::fromPath(__DIR__.'/../fixtures/image/blank.jpg');
    $imagePng = Image::fromPath(__DIR__.'/../fixtures/image/blank.png');

    expect($imageJpg->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('image_jpg'))
        ->and($imagePng->serialize())
        ->toBeString()
        ->toBe(getPropertyFixture('image_png'));
});

test('a image property can be added to a vcard', function () {
    $imageJpg = Image::fromPath(__DIR__.'/../fixtures/image/blank.jpg');
    $vcardJpg = new Vcard();
    $vcardJpg->add($imageJpg);

    $imagePng = Image::fromPath(__DIR__.'/../fixtures/image/blank.png');
    $vcardPng = new Vcard();
    $vcardPng->add($imagePng);

    expect($vcardJpg->toArray())
        ->toHaveCount(3)
        ->toContain($imageJpg->toArray())
        ->and($vcardPng->toArray())
        ->toHaveCount(3)
        ->toContain($imagePng->toArray());
});
