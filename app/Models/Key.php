<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App\Models
 *
 * @property Translation[]|Collection $translations
 * @property string $name
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
