<?php

namespace App\Support\Settings;

final readonly class Application
{
    public function __construct(
        private ?string $timezone,
    ) {}

    public static function new(): Application
    {
        return new self(
            timezone: config('settings.app.timezone')
        );
    }

    public function timezone(): ?string
    {
        return $this->timezone;
    }
}
