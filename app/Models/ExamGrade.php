<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamGrade extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'exam_grades';

    protected $guarded = [];

    function exam(): BelongsTo {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
