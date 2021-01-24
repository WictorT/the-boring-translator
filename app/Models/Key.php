<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property Translation[] $translations
 */
class Key extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $visible = [
        'id',
        'name',
        'translations'
    ];

    public function translations()
    {
        return $this->hasMany(Translation::class);
    }
}
