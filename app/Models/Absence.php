<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    use HasFactory;
    protected $table= 'absences';

    protected $guarded = [];

    protected $primaryKey='id';

    function subject(): BelongsTo {
        return $this->belongsTo(Subject::class);
    }

    function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }
}
