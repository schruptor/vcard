<?php

namespace Schruptor\Vcard\Properties;

use Spatie\LaravelData\Attributes\Computed;

class Mobile extends Phone
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $number
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "TEL;type=CELL;MOBILE:$this->number";
    }
}
