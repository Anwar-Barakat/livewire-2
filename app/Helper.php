<?php

use App\Models\Setting;
use App\NullSetting;
use Illuminate\Support\Facades\Cache;

function settings($key)
{
    $settings = Cache::rememberForever('settings', function () {
        return Setting::first() ?? NullSetting::make();
    });

    if ($settings)
        return $settings->{$key};
}