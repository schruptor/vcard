<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Website extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $url,
        public string $type = 'PRIVATE',
    ) {
        $this->class = $this::class;
    }

    public function serialize(): string
    {
        return "URL;$this->type:$this->url";
    }
}
