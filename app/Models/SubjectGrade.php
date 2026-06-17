<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectGrade extends Model
{
    use HasFactory;

    protected $table = 'subject_grades';

    protected $primaryKey = 'id';
    
    protected $guarded = [];

    function subject(): BelongsTo {
        return $this->belongsTo(Subject::class);
    }

    function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
