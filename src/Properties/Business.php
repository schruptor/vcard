<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Business extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $name,
        public string $unit,
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "ORG;CHARSET=UTF-8:$this->name;$this->unit";
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
