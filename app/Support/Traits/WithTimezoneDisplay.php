<?php

namespace App\Support\Traits;

use App\Support\Settings;
use Illuminate\Support\Carbon;

trait WithTimezoneDisplay
{
    public function registerInApplicationTimezone(): void
    {
        /* @var Carbon $this */
        Carbon::macro('inApplicationTimezone', fn () => $this->tz(
            value: Settings::application()->timezone()
        ));
    }

    public function registerInUserTimezone(): void
    {
        /* @var Carbon $this */
        Carbon::macro('inUserTimezone', fn () => $this->tz(
            value: auth()->user()?->timezone ?? Settings::application()->timezone()
        ));
    }
}
