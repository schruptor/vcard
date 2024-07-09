<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Birthday extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $date
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "BDAY:$this->date";
    }
}
