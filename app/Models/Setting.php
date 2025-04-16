<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;

    protected $fillable = [
        'background_color',
        'toggle',
        'type',
        'password',
        'phone',
        'age_from',
        'age_to',
    ];

    protected $casts = [
        'type' => StatusEnum::class
    ];

    protected $hidden = [
        'password'
    ];
}
