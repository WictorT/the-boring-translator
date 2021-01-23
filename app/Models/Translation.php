<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 *
 * @property string $value
 * @property string $language_iso_code
 * @property int $key_id
 *
 * @property Language $language
 * @property Key $key
 */
class Translation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'language_iso_code',
        'key_id',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_iso_code', 'iso_code');
    }

    public function key()
    {
        // TODO remove explicit ids
        return $this->belongsTo(Key::class, 'key_id', 'id');
    }
}
