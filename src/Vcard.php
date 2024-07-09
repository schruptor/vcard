<?php

namespace Schruptor\Vcard;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;
use Schruptor\Vcard\Properties\Base\Begin;
use Schruptor\Vcard\Properties\Base\End;
use Schruptor\Vcard\Properties\Base\PropertieContract;
use Schruptor\Vcard\Properties\Birthday;
use Schruptor\Vcard\Properties\Business;
use Schruptor\Vcard\Properties\Image;
use Schruptor\Vcard\Properties\JobTitle;
use Schruptor\Vcard\Properties\Name;
use Schruptor\Vcard\Properties\Note;
use Schruptor\Vcard\Properties\Source;
use Illuminate\Support\Facades\Response as ResponseFacade;

class Vcard
{
    private Collection $properties;

    public function __construct(
        private bool $endIsSet = false
    )
    {
        $this->properties = new Collection();
        $this->properties->add(new Begin());
    }

    public function add(PropertieContract $propertie): self
    {
        $this->properties->add($propertie);

        return $this;
    }

    public function forceEnd(string $date, string $time): self
    {
        $this->properties->add(new End($date, $time));

        $this->endIsSet = true;

        return $this;
    }

    public function toArray(): array
    {
        $this->validate();

        return $this->toArrayWithoutValidation();
    }

    public function toArrayWithoutValidation(): array
    {
        $this->endCard();

        return $this->properties->toArray();
    }

    public function serialize(): string
    {
        $this->validate();

        return $this->serializeWithoutValidation();
    }

    public function serializeWithoutValidation(): string
    {
        $this->endCard();
        $output = '';

        $this->properties->each(function (PropertieContract $property) use (&$output) {
            $output = $output.$property->serialize().PHP_EOL;
        });

        return trim($output);
    }

    public function validate(): void
    {
        $this->properties = $this->properties->unique(function (PropertieContract $item) {
            return match ($item->class) {
                Name::class => Name::class,
                JobTitle::class => JobTitle::class,
                Image::class => Image::class,
                Business::class => Business::class,
                Source::class => Source::class,
                Note::class => Note::class,
                Birthday::class => Birthday::class,
                default => $item,
            };
        });
    }

    private function endCard(): void
    {
        if (! $this->endIsSet) {
            $this->properties->add(new End());
        }
    }

    public function save($path): bool
    {
        return (bool) file_put_contents($path, $this->serialize());
    }

    public function response(): Response
    {
        return ResponseFacade
            ::make(
            $this->serialize(),
            200,
            $this->getAssociativeHeaders(),
        );
    }

    private function getAssociativeHeaders(): array
    {
        return [
            'Content-type' => $this->getContentType().'; charset=utf-8',
            'Content-Disposition' => 'attachment; filename='.Uuid::uuid4().'.'.$this->getFileExtension(),
            'Content-Length' => mb_strlen($this->serialize(), '8bit'),
            'Connection' => 'close',
        ];
    }

    protected function getContentType(): string
    {
        return ($this->isIOS7()) ? 'text/x-vcalendar' : 'text/x-vcard';
    }

    protected function isIOS7(): bool
    {
        return $this->isIOS() && $this->shouldAttachmentBeCal();
    }

    protected function shouldAttachmentBeCal(): bool
    {
        $browser = $this->getUserAgent();

        $matches = [];
        preg_match('/os (\d+)_(\d+)\s+/', $browser, $matches);
        $version = isset($matches[1]) ? ((int) $matches[1]) : 999;

        return $version < 8;
    }

    protected function isIOS(): bool
    {
        $browser = $this->getUserAgent();

        return strpos($browser, 'iphone') || strpos($browser, 'ipod') || strpos($browser, 'ipad');
    }

    protected function getUserAgent(): string
    {
        if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
            $browser = strtolower($_SERVER['HTTP_USER_AGENT']);
        } else {
            $browser = 'unknown';
        }

        return $browser;
    }

    protected function getFileExtension(): string
    {
        return ($this->isIOS7()) ? 'ics' : 'vcf';
    }
}
