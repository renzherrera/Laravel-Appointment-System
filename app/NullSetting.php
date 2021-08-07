<?php

use App\Models\Setting;

class NullSetting extends Setting 
{
    protected $attributes = [
            'site_title' => 'Default Title',
            'site_name' => 'Default Name',
            'site_email' => 'default@gmail.com',
            'footer_text' => 'Default Footer',
            'sidebar_collapse' => false,
    ];
}