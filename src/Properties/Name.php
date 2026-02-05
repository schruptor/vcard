<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Name extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $title,
        public string $nickname,
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "N;CHARSET=UTF-8:$this->lastName;$this->firstName;;$this->title;$this->nickname";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
