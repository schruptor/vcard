<?php

namespace Schruptor\Vcard\Properties;

use Spatie\LaravelData\Attributes\Computed;

class Fax extends Phone
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $number,
        public string $type = 'HOME',
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "TEL;type=FAX;$this->type:$this->number";
    }
}
