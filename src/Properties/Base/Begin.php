<?php

namespace Schruptor\Vcard\Properties\Base;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Begin extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return 'BEGIN:VCARD'.PHP_EOL.'VERSION:3.0';
    }
}
