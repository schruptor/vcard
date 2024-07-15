<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Address extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $street,
        public string $city,
        public string $zip,
        public string $country,
        public string $type = 'HOME',
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "ADR;CHARSET=UTF-8;$this->type;type=pref:;;$this->street;$this->city;;$this->zip;$this->country".PHP_EOL.
            "LABEL;$this->type;PREF;ENCODING=QUOTED-PRINTABLE;CHARSET=UTF-8:$this->street=0D=0A=".PHP_EOL.
            "$this->zip $this->city $this->country";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
