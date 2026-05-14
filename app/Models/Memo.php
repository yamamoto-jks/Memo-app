<?php

namespace App\Models;

use Database\Factories\MemoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $content
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Database\Factories\MemoFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Memo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[Fillable('content')]
class Memo extends Model
{
    /** @use HasFactory<MemoFactory> */
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
