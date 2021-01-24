<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property string $iso_code
 * @property string $is_rtl
 */
class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
        'is_rtl',
    ];

    protected $visible = [
        'id',
        'name',
        'iso_code',
        'is_rtl',
    ];
}
