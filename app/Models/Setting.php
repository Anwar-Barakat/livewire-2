<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_email',
        'site_title',
        'footer',
        'sidebar_coll',
    ];

    protected $casts = [
        'sidebar_coll' => 'boolean',
    ];
}