<?php

namespace App;

use App\Models\Setting;

class NullSetting extends Setting
{
    protected $attributes = [
        'site_name'     => 'Default Name',
        'site_title'    => 'Default Title',
        'site_email'    => 'Default E-mail',
        'footer'        => 'Default Footer Text',
        'sidebar_coll'  => false
    ];
}