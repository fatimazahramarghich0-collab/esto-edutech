<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SemesterGrade extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'semester_grades';

    protected $guarded = [];

    function semester(): BelongsTo {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    function student() : BelongsTo {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

}
