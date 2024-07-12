<?php

namespace Schruptor\Vcard\Properties;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Computed;
use Schruptor\Vcard\Properties\Base\PropertieContract;

class Fax extends Data implements PropertieContract
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
