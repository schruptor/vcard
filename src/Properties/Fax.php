<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

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
