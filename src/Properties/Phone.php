<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Phone extends Data implements PropertieContract
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
        return "TEL;type=$this->type;VOICE:$this->number";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
