<?php

namespace Schruptor\Vcard\Properties;

use Schruptor\Vcard\Properties\Base\PropertieContract;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class Image extends Data implements PropertieContract
{
    #[Computed]
    public string $class;

    public function __construct(
        public string $base64,
        public string $type,
    ) {
        $this->type = str($this->type)->upper();
        $this->class = $this::class;
    }

    public static function fromPath(string $path): self
    {
        $base64 = base64_encode(file_get_contents($path));
        $type = pathinfo($path, PATHINFO_EXTENSION);

        return new self($base64, $type);
    }

    public function serialize(): string
    {
        return "PHOTO;ENCODING=b;TYPE=$this->type:$this->base64";
    }
}
