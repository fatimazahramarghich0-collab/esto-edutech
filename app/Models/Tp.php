<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tp extends Model
{
    use HasFactory;

    protected $table = 'tps';

    protected $primaryKey = 'id';

    protected $guarded = [];

    function teacher(): BelongsTo {
        return $this->belongsTo(Teacher::class);
    }
    function coures(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

}
